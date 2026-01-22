<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Ciudades;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DomainException;
use Illuminate\Http\JsonResponse;
use App\Models\Carrito;

class RegisterController extends Controller
{
    /*
    | STEP 1 – Documento
    */

    /**
     * Mostrar pantalla solo documento (cédula/RUC)
     */
    public function step1(Request $request)
    {
        $redirect = $request->query('redirect', route('catalogo.index'));
        return view('auth.register-step1', compact('redirect'));
    }

    /**
     * Procesar documento y decidir flujo
     */
    public function step1Check(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'required|in:CEDULA,RUC',
            'cli_ruc_ced'    => 'required',
            'redirect'       => 'nullable|string',
        ], [
            'tipo_documento.required' => 'Debe seleccionar el tipo de documento',
            'tipo_documento.in'       => 'Tipo de documento no válido',
            'cli_ruc_ced.required'    => 'La cédula/RUC es obligatoria',
        ]);

        $doc  = trim($request->cli_ruc_ced);
        $tipo = $request->tipo_documento;

        $longitud = $tipo === 'RUC' ? 13 : 10;
        if (strlen($doc) !== $longitud) {
            return back()->withErrors([
                'cli_ruc_ced' => $tipo === 'RUC'
                    ? 'Para RUC deben ser 13 dígitos.'
                    : 'Para cédula deben ser 10 dígitos.'
            ])->withInput();
        }

        $redirect = $request->input('redirect', route('catalogo.index'));

        $cliente = Clientes::where('cli_ruc_ced', $doc)->first();

        // Cliente NO existe → formulario completo
        if (!$cliente) {
            return redirect()->route('register.form', [
                'redirect'        => $redirect,
                'tipo_documento'  => $tipo,
                'cli_ruc_ced'     => $doc,
            ]);
        }

        // Cliente existe y ya tiene cuenta
        if (!is_null($cliente->user_id)) {
            return redirect()->route('login.form')
                ->with('info', 'Este cliente ya tiene una cuenta registrada. Inicia sesión para continuar.');
        }

        // Cliente existe y NO tiene cuenta
        return redirect()->route('register.existing.form', [
            'redirect'        => $redirect,
            'tipo_documento'  => $tipo,
            'cli_ruc_ced'     => $doc,
        ]);
    }

    /*
    | STEP 2A – Cliente existente sin cuenta
    */

    /**
     * Mostrar form: email + password
     */
    public function existingForm(Request $request)
    {
        $data = $request->validate([
            'tipo_documento' => 'required|in:CEDULA,RUC',
            'cli_ruc_ced'    => 'required',
            'redirect'       => 'nullable|string',
        ]);

        return view('auth.register-step2-existing', [
            'tipo_documento' => $data['tipo_documento'],
            'cli_ruc_ced'    => $data['cli_ruc_ced'],
            'redirect'       => $data['redirect'] ?? route('catalogo.index'),
        ]);
    }

    /**
     * Crear user y asociar a cliente existente
     */
    public function storeExisting(Request $request)
    {
        $rules = [
            'tipo_documento' => 'required|in:CEDULA,RUC',
            'cli_ruc_ced'    => 'required',
            'cli_email'      => 'required|email|max:50',
            'password'       => 'required|min:8|confirmed',
            'redirect'       => 'nullable|string',
        ];

        if ($request->tipo_documento === 'RUC') {
            $rules['cli_ruc_ced'] .= '|digits:13';
        } else {
            $rules['cli_ruc_ced'] .= '|digits:10';
        }

        $messages = [
            'cli_ruc_ced.required' => 'La cédula/RUC es obligatoria',
            'cli_ruc_ced.digits'   => 'Documento con longitud inválida',
            'cli_email.required'   => 'El email es obligatorio',
            'cli_email.email'      => 'El email no es válido',
            'password.required'    => 'La contraseña es obligatoria',
            'password.min'         => 'La contraseña debe tener mínimo 8 caracteres',
            'password.confirmed'   => 'Las contraseñas no coinciden',
        ];

        $request->validate($rules, $messages);

        $redirect = $request->input('redirect', route('catalogo.index'));

        try {
            $user = Register::crearUserYAsociarAClienteExistente(
                $request->cli_ruc_ced,
                $request->cli_email,
                $request->password
            );
        } catch (DomainException $e) {
            return back()
                ->withErrors(['cli_email' => $e->getMessage()])
                ->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();
        Carrito::mergeCookieCartToUser($user->id);


        return redirect($redirect);
    }

    /*
    | STEP 2B – Cliente nuevo (formulario completo)
    */

    /**
     * Mostrar formulario completo
     */
    public function form(Request $request)
    {
        $ciudades = Ciudades::all();

        $redirect = $request->query('redirect', route('catalogo.index'));
        $tipo     = $request->query('tipo_documento', old('tipo_documento', 'RUC'));
        $doc      = $request->query('cli_ruc_ced', old('cli_ruc_ced'));

        //si llega doc por query, decidir flujo aquí también
        if (!empty($doc)) {
            $doc = trim($doc);

            $cliente = Clientes::where('cli_ruc_ced', $doc)->first();

            // Existe y NO tiene cuenta -> manda al step2 existing
            if ($cliente && is_null($cliente->user_id)) {
                return redirect()->route('register.existing.form', [
                    'redirect'       => $redirect,
                    'tipo_documento' => $tipo,
                    'cli_ruc_ced'    => $doc,
                ]);
            }

            // Existe y YA tiene cuenta -> manda a login
            if ($cliente && !is_null($cliente->user_id)) {
                return redirect()->route('login.form')
                    ->with('info', 'Este cliente ya tiene una cuenta registrada. Inicia sesión para continuar.');
            }
        }

        return view('auth.register', [
            'ciudades'       => $ciudades,
            'redirect'       => $redirect,
            'tipo_documento' => $tipo,
            'cli_ruc_ced'    => $doc,
        ]);
    }

    /**
     * Procesar registro completo (cliente nuevo)
     */
    public function store(Request $request)
    {
        //Normalizar doc/tipo desde wizard (si vienen)
        $docWizard  = $request->input('cli_ruc_ced_wizard');
        $tipoWizard = $request->input('tipo_documento_wizard');

        if (!empty($docWizard)) {
            $request->merge([
                'cli_ruc_ced'    => trim($docWizard),
                'tipo_documento' => $tipoWizard ?: $request->input('tipo_documento'),
            ]);
        }

        $rules = [
            'cli_nombre'       => 'required|string|max:50',
            'cli_telefono'     => 'required|digits:10',
            'cli_direccion'    => 'required|string|max:100',
            'ciudad_id'        => 'required_without:ciudad_id_hidden|exists:ciudades,id',
            'ciudad_id_hidden' => 'required_without:ciudad_id|exists:ciudades,id',
            'cli_email'        => 'required|email|max:50',
            'tipo_documento'   => 'required|in:CEDULA,RUC',
            'cli_ruc_ced'      => 'required',
            'password'         => 'required|min:8|confirmed',
            'redirect'         => 'nullable|string',
        ];

        $messages = [
            'cli_nombre.required'     => 'El nombre es obligatorio',
            'cli_telefono.required'   => 'El teléfono es obligatorio',
            'cli_telefono.digits'     => 'El teléfono debe ser de 10 dígitos',
            'cli_direccion.required'  => 'La dirección es obligatoria',
            'ciudad_id.required'      => 'La ciudad es obligatoria',
            'ciudad_id.exists'        => 'La ciudad no es válida',
            'cli_email.required'      => 'El email es obligatorio',
            'cli_email.email'         => 'El email no es válido',
            'tipo_documento.required' => 'Debe seleccionar el tipo de documento',
            'tipo_documento.in'       => 'Tipo de documento no válido',
            'cli_ruc_ced.required'    => 'La cédula/RUC es obligatoria',
            'password.required'       => 'La contraseña es obligatoria',
            'password.min'            => 'La contraseña debe tener mínimo 8 caracteres',
            'password.confirmed'      => 'Las contraseñas no coinciden',
        ];

        if ($request->tipo_documento === 'RUC') {
            $rules['cli_ruc_ced'] .= '|digits:13';
        } else {
            $rules['cli_ruc_ced'] .= '|digits:10';
        }

        // Normalizar ciudad
        $ciudadId = $request->input('ciudad_id_hidden') ?: $request->input('ciudad_id');
        $request->merge(['ciudad_id' => $ciudadId]);

        $redirect = $request->input('redirect', route('catalogo.index'));

        $request->validate($rules, $messages);

        try {
            $user = Register::registrarCliente($request->all());
        } catch (DomainException $e) {
            return back()->withErrors(['cli_email' => $e->getMessage()])->withInput();
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['general' => 'Error interno: ' . $e->getMessage()])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();
        Carrito::mergeCookieCartToUser($user->id);

        return redirect($redirect);
    }

    /*
    | Endpoint opcional (AJAX seguro)
    */

    public function verificarCliente(Request $request): JsonResponse
    {
        $request->validate([
            'cli_ruc_ced'    => 'required',
            'tipo_documento' => 'required|in:CEDULA,RUC',
        ]);

        $doc  = trim($request->cli_ruc_ced);
        $tipo = $request->tipo_documento;

        if ($tipo === 'RUC' && strlen($doc) !== 13) {
            return response()->json(['found' => false], 422);
        }
        if ($tipo === 'CEDULA' && strlen($doc) !== 10) {
            return response()->json(['found' => false], 422);
        }

        $cliente = Clientes::where('cli_ruc_ced', $doc)->first();

        if (!$cliente) {
            return response()->json(['found' => false]);
        }

        if (!is_null($cliente->user_id)) {
            return response()->json(['found' => true, 'has_account' => true]);
        }

        return response()->json(['found' => true, 'has_account' => false]);
    }
}
