<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
     if (!Auth::check()) {
        abort(403, 'No autenticado');
    }
    $user = Auth::user();
    $rol = strtolower(trim($user->rol));
    $rolesPermitidos = array_map(fn($r) => strtolower(trim($r)), $roles);

    if (!in_array($rol, $rolesPermitidos)) {
        abort(403, 'Acceso no autorizado.');
    }

    return $next($request);
    }
}
