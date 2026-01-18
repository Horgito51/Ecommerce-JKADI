<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clientes;
use App\Models\Ciudades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        // 1) Validación (misma lógica que Clientes + password)
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

        $email = trim(mb_strtolower($request->cli_email));
        $doc   = trim($request->cli_ruc_ced);

        // 2) Transacción para asegurar consistencia
        return DB::transaction(function () use ($request, $email, $doc, $redirect) {

            // Buscar cliente existente por (cedula/ruc) o email
            $cliente = Clientes::where('cli_ruc_ced', $doc)
                ->orWhere('cli_email', $email)
                ->first();

            // Buscar user existente por email (users.email es unique)
            $user = User::where('email', $email)->first();

            // Si ya existe cliente y ya tiene cuenta asociada
            if ($cliente && !is_null($cliente->user_id)) {
                return back()
                    ->withErrors(['cli_email' => 'Este cliente ya tiene una cuenta registrada. Inicie sesión.'])
                    ->withInput();
            }

            // Si no existe user, crearlo
            if (!$user) {
                $user = User::create([
                    'name'     => $request->cli_nombre,
                    'email'    => $email,
                    'password' => Hash::make($request->password),
                    'rol'      => 'cliente',
                ]);
            }

            // Si existe cliente -> asociarlo al user
            if ($cliente) {
                $cliente->user_id = $user->id;
                $cliente->cli_email = $email; // por si estaba vacío o diferente
                $cliente->save();
            } else {
                // Si NO existe cliente -> crear cliente y asociarlo
                Clientes::createClientes([
                    'cli_nombre'    => $request->cli_nombre,
                    'cli_ruc_ced'   => $doc,
                    'cli_telefono'  => $request->cli_telefono,
                    'ciudad_id'     => $request->ciudad_id,
                    'cli_direccion' => $request->cli_direccion,
                    'cli_email'     => $email,
                    'estado_cli'    => 'ACT',
                    'user_id'       => $user->id,
                ]);
            }

            // 3) Logear al usuario y redirigir
            Auth::login($user);
            request()->session()->regenerate();

            return redirect($redirect);
        });
    }
}
