<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validar datos
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('name', $request->name)->first();

        //Validar credenciales
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login' => 'Usuario o contraseña incorrectos'
            ]);
        }

        // Guardar usuario en sesión
        session(['user_id' => $user->id]);

        // Redirigir según rol
        if ($user->rol === 'gerente_bodega') {
            return redirect('/admin/bodega/productos');
        }

        if ($user->rol === 'gerente_compras') {
            return redirect('/admin/compras/proveedores');
        }

        if ($user->rol === 'gerente_ventas') {
            return redirect('/admin/ventas/clientes');
        }


        abort(403, 'Rol no válido');
    }
}
