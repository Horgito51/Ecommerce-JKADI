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

    $request->validate([
        'name' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('name', $request->name)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'login' => 'Usuario o contraseña incorrectos'
        ]);
    }
    Auth::login($user);
    $request->session()->regenerate();

    // 5. Redirigir según rol
    if ($user->rol === 'gerente_bodega') {
        return redirect('/admin');
    }

    if ($user->rol === 'gerente_compras') {
        return redirect('/admin');
    }

    if ($user->rol === 'gerente_ventas') {
        return redirect('/admin');
    }

    if ($user->rol === 'admin') {
        return redirect('/admin');
    }

    abort(403, 'Rol no válido');
}
}
