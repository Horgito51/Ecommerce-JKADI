<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
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

        //BACKOFFICE
        if (in_array($user->rol, ['gerente_bodega', 'gerente_compras', 'gerente_ventas', 'admin'])) {
            return redirect('/admin');
        }

        //ECOMMERCE (cliente)
        if (in_array($user->rol, ['cliente', 'usuario'])) {

            $redirect = $request->input('redirect')
                ?? $request->session()->pull('redirect_after_login')
                ?? route('catalogo.index');

            return redirect($redirect);
        }

        //fallback: por si algún rol raro se coló
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors(['login' => 'Rol no autorizado'])->withInput($request->only('log_usuario'));
    }
}
