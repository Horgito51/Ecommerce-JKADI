<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});


use App\Models\User;

Route::get('/demo-login/{id}', function ($id) {
    $user = User::findOrFail($id);
    session(['user_id' => $user->id]);

    return "Sesión iniciada como {$user->name} ({$user->rol})";
});


Route::middleware(['rol:gerente_bodega'])
    ->prefix('backoffice')
    ->group(function () {

        Route::get('/', function () {
            return 'Backoffice funcionando 🚀';
        });

    });

Route::middleware(['rol:gerente_compras'])
    ->prefix('backoffice/compras')
    ->group(function () {

        Route::get('/', function () {
            return 'Backoffice Compras 🧾';
        });

    });
 
Route::middleware(['rol:gerente_ventas'])
    ->prefix('backoffice/ventas')
    ->group(function () {

        Route::get('/', function () {
            return 'Backoffice Ventas 💰';
        });

    });
 
