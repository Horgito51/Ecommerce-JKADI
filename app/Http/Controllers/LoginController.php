<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //Validaciones
        $request->validate(
            [
                'log_usuario' => 'required',
                'password'    => 'required',
            ],
            [
                'log_usuario.required' => 'El usuario es obligatorio',
                'password.required'    => 'La contraseña es obligatoria',
            ]
        );

        if (!Auth::attempt([
            'name'     => $request->log_usuario,
            'password' => $request->password
        ])) {
            return back()
                ->withErrors(['login' => 'El usuario o la contraseña son incorrectos'])
                ->withInput($request->only('log_usuario'));
        }
        $request->session()->regenerate();

        $user = Auth::user();

        //Acceso para el rol
        if (in_array($user->rol, ['gerente_bodega', 'gerente_compras', 'gerente_ventas', 'admin'])) {
            return redirect('/admin');
        }

        abort(403, 'Rol no válido');
    }
}
