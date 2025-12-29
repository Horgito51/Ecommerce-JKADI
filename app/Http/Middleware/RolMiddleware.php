<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Usuario guardado en sesión
        $userId = session('user_id');
        $user = User::find($userId);
        if (!$user || !in_array($user->rol, $roles)) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
