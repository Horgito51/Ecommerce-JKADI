<?php

use App\Http\Controllers\Ecommerce\CatalogoController;
use App\Http\Controllers\Ecommerce\CarritoController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\FacturaController;
use GuzzleHttp\Client;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProveedorController;
//Intento del logout pa todos 
use Illuminate\Support\Facades\Auth;

Route::get('/portada', function () {

    return view('Ecommerce.dashboard');
})->name('portada.index');


// ECOMMERCE
Route::get('/', function () {

    return redirect()->route('portada.index');
});

Route::group([],function(){
    Route::get('/carrito',[CarritoController::class,'index'])->name('carrito.index');


});


Route::group([], function () {
    Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
    Route::get('/detalle/{id}', [CatalogoController::class, 'show'])->name('catalogo.detalle');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login.form');

    Route::post('/login', 'login')->name('login.post');
});

Route::prefix('admin')->group(function () {

    // DASHBOARD ADMIN
    Route::middleware(['rol:admin'])->group(function () {
        Route::get('/', function (){
            return view('admin.dashboard');
        })->name('admin.index');
    });

    // BODEGA
    Route::middleware(['rol:admin,gerente_bodega'])
        ->prefix('bodega')
        ->group(function () {

            Route::get('/', function () {
                return view('admin.dashboard');
            })->name('admin.index');;

        });

    // COMPRAS
    Route::middleware(['rol:admin,gerente_compras'])
        ->prefix('compras')
        ->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard');
            })->name('admin.index');;
            Route::resource('proveedores', ProveedorController::class);

            Route::resource('ordenes',CompraController::class);
            Route::get('ordenes/{id}/aprobar', [CompraController::class, 'aprobar'])->name('ordenes.aprobar');
        });

    // VENTAS
    Route::middleware(['rol:admin,gerente_ventas'])
        ->prefix('ventas')
        ->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard');
            })->name('admin.index');;

            Route::resource('clientes', ClientesController::class);

            Route::resource('facturas',FacturaController::class);
            Route::get('/facturas/{id}/aprobar', [FacturaController::class, 'aprobar'])
            ->name('facturas.aprobar');
        });
    //productos
    Route::middleware(['rol:admin,gerente_bodega,gerente_compras,gerente_ventas'])
    ->group(function () {
        Route::get('/', function () {
                return view('admin.dashboard');
            })->name('admin.index');;
           Route::resource('productos', ProductoController::class);
    });

});
//Ruta para el logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/portada');
})->name('logout');

