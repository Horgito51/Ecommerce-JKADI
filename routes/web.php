<?php

use App\Http\Controllers\Ecommerce\CatalogoController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClientesController;
use GuzzleHttp\Client;

Route::get('/', function () {

    return view('Ecommerce.dashboard');
});


Route::get('/demo-login/{id}', function ($id) {
    $user = User::findOrFail($id);
    session(['user_id' => $user->id]);

    return "Sesión iniciada como {$user->name} ({$user->rol})";
});


Route::get('/catalogo',[CatalogoController::class,'index'])->name('catalogo.index');

// Route::middleware(['rol:gerente_bodega'])
//     ->prefix('admin')
//     ->group(function () {

//         Route::get('/', function () {
//             return 'Backoffice funcionando 🚀';
//         });

//         Route::resource('productos',ProductoController::class);
//     });

// Route::middleware(['rol:gerente_compras'])
//     ->prefix('admin/compras')
//     ->group(function () {

//         Route::get('/', function () {
//             return 'Backoffice Compras 🧾';
//         });

//     });

// Route::middleware(['rol:gerente_ventas'])
//     ->prefix('admin/ventas')
//     ->group(function () {

//         Route::get('/', function () {
//             return 'Backoffice Ventas 💰';
//         });
//     });


