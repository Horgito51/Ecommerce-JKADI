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
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'El correo es obligatorio',
                'email.email'    => 'Ingrese un correo válido',
                'password.required' => 'La contraseña es obligatoria',
            ]
        );

        if (!Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ])) {
            return back()
                ->withErrors(['login' => 'El correo o la contraseña son incorrectos'])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // BACKOFFICE
        if (in_array($user->rol, ['gerente_bodega', 'gerente_compras', 'gerente_ventas', 'admin'])) {
            return redirect('/admin');
        }

        // ECOMMERCE
        if (in_array($user->rol, ['cliente', 'usuario'])) {
            $redirect = $request->input('redirect')
                ?? $request->session()->pull('redirect_after_login')
                ?? route('catalogo.index');

            return redirect($redirect);
        }

        // fallback
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors(['login' => 'Rol no autorizado']);
    }

}
