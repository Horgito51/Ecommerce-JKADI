<?php

use App\Http\Controllers\Ecommerce\CatalogoController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClientesController;
use GuzzleHttp\Client;
use App\Http\Controllers\LoginController;


// ECOMMERCE
Route::get('/', function () {

    return view('Ecommerce.dashboard');
});

Route::get('/portada', function () {

    return view('Ecommerce.dashboard');
})->name('portada.index');

Route::get('/catalogo',[CatalogoController::class,'index'])->name('catalogo.index');
Route::get('/detalle/{id}',[CatalogoController::class,'show'])->name('catalogo.detalle');




// LOGIN 
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login.form');

    Route::post('/login', 'login')->name('login.post');
});



// REDIRECCION A LA GESTION DE PRODUCTOS, PROVEEDORES Y CLIENTES
Route::middleware(['rol:gerente_bodega'])
     ->prefix('admin/bodega')
     ->group(function () {

         Route::get('/', function () {
             return 'Backoffice funcionando 🚀';
         });

         Route::resource('productos',ProductoController::class);
     });

Route::middleware(['rol:gerente_compras'])
     ->prefix('admin/compras')
     ->group(function () {

         Route::get('/', function () {
            return 'Backoffice Compras 🧾';
         });

     });

 Route::middleware(['rol:gerente_ventas'])
     ->prefix('admin/ventas')
     ->group(function () {
         Route::get('/', function () {
             return 'Backoffice Ventas 💰';
         });

         Route::resource('clientes',ClientesController::class);

     });


