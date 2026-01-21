<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\Ciudades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DomainException;
use Illuminate\Http\JsonResponse;
use App\Models\Clientes;

class RegisterController extends Controller
{
    /**
     * Mostrar formulario de registro
     */
    public function form(Request $request)
    {
        $ciudades = Ciudades::all();
        $redirect = $request->query('redirect', route('catalogo.index'));

        return view('auth.register', compact('ciudades', 'redirect'));
    }

    /**
     * Procesar registro
     */
    public function store(Request $request)
    {
        // 1) Validación (se queda en Controller)
        $rules = [
            'cli_nombre'       => 'required|string|max:50',
            'cli_telefono'     => 'required|digits:10',
            'cli_direccion'    => 'required|string|max:100',
            'ciudad_id'        => 'required|exists:ciudades,id',
            'cli_email'        => 'required|email|max:50',
            'tipo_documento'   => 'required|in:CEDULA,RUC',
            'cli_ruc_ced'      => 'required',
            'password'         => 'required|min:8|confirmed',
            'redirect'         => 'nullable|string',
        ];

        $messages = [
            'cli_nombre.required' => 'El nombre es obligatorio',
            'cli_telefono.required' => 'El teléfono es obligatorio',
            'cli_telefono.digits' => 'El teléfono debe ser de 10 dígitos',
            'cli_direccion.required' => 'La dirección es obligatoria',
            'ciudad_id.required' => 'La ciudad es obligatoria',
            'ciudad_id.exists' => 'La ciudad no es válida',
            'cli_email.required' => 'El email es obligatorio',
            'cli_email.email' => 'El email no es válido',
            'tipo_documento.required' => 'Debe seleccionar el tipo de documento',
            'tipo_documento.in' => 'Tipo de documento no válido',
            'cli_ruc_ced.required' => 'La cédula/RUC es obligatoria',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener mínimo 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];

        // Longitud por tipo documento
        if ($request->tipo_documento === 'RUC') {
            $rules['cli_ruc_ced'] .= '|digits:13';
        } else {
            $rules['cli_ruc_ced'] .= '|digits:10';
        }

        $request->validate($rules, $messages);

        $redirect = $request->input('redirect', route('catalogo.index'));

        // 2) Lógica de negocio al Model (Register)
        try {
            $user = Register::registrarCliente($request->all());
        } catch (DomainException $e) {
            return back()
                ->withErrors(['cli_email' => $e->getMessage()])
                ->withInput();
        }

        // 3) Sesión/HTTP flow se queda en Controller
        Auth::login($user);
        $request->session()->regenerate();

        return redirect($redirect);
    }

    public function verificarCliente(Request $request): JsonResponse
{
    $request->validate([
        'cli_ruc_ced' => 'required',
        'tipo_documento' => 'nullable|in:CEDULA,RUC',
    ]);

    $doc  = trim($request->cli_ruc_ced);
    $tipo = $request->tipo_documento;

    // Validación de longitud según tipo (opcional pero útil)
    if ($tipo === 'RUC' && strlen($doc) !== 13) {
        return response()->json([
            'found' => false,
            'message' => 'Para RUC deben ser 13 dígitos.',
        ], 422);
    }
    if ($tipo === 'CEDULA' && strlen($doc) !== 10) {
        return response()->json([
            'found' => false,
            'message' => 'Para cédula deben ser 10 dígitos.',
        ], 422);
    }

    $cliente = Clientes::where('cli_ruc_ced', $doc)->first();

    if (!$cliente) {
        return response()->json([
            'found' => false,
            'message' => 'No encontramos un cliente con este documento. Puedes continuar con el registro ingresando tus datos.',
        ]);
    }

    // Si ya tiene cuenta asociada
    if (!is_null($cliente->user_id)) {
        return response()->json([
            'found' => true,
            'has_account' => true,
            'message' => 'Este cliente ya tiene una cuenta registrada. Inicia sesión para continuar.',
        ]);
    }

    // Existe cliente pero aún no tiene cuenta -> autocompletar
    return response()->json([
        'found' => true,
        'has_account' => false,
        'cliente' => [
            'cli_nombre' => $cliente->cli_nombre,
            'cli_telefono' => $cliente->cli_telefono,
            'ciudad_id' => $cliente->ciudad_id,
            'cli_direccion' => $cliente->cli_direccion,
            'cli_email' => $cliente->cli_email,
        ],
        'message' => 'Encontramos un registro asociado a este documento. Parece que ya te atendimos en tienda física. Autocompletamos tus datos para que termines el registro más rápido. Verifica que todo esté correcto antes de continuar.',
    ]);
}
}
