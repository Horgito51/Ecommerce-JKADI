<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\Ciudades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DomainException;

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
}
