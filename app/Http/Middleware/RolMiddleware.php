<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        // 🔴 SOLO PARA DESARROLLO (sin login)
        $user = User::first(); // simula usuario

        if (!$user || $user->rol !== $rol) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
    