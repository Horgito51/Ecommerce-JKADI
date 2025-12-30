<?php

use App\Http\Controllers\Ecommerce\CatalogoController;
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

Route::get('/portada', function () {

    return view('Ecommerce.dashboard');
})->name('portada.index');


// ECOMMERCE
Route::get('/', function () {

    return redirect()->route('portada.index');
});




Route::group([], function () {
    Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
    Route::get('/detalle/{id}', [CatalogoController::class, 'show'])->name('catalogo.detalle');
});


// CLIENTES PROVEEDORES Y PRODUCTOS
// Route::get('/clientes',[ClientesController::class,'index']);

// Route::get('/productos',[ProductoController::class,'index']);

// LOGIN
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login.form');

    Route::post('/login', 'login')->name('login.post');
});

Route::prefix('admin')->group(function () {

    // DASHBOARD ADMIN
    Route::middleware(['rol:admin'])->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        });
    });

    // BODEGA
    Route::middleware(['rol:admin,gerente_bodega'])
        ->prefix('bodega')
        ->group(function () {

            Route::get('/', function () {
                return 'Backoffice funcionando 🚀';
            });

        });

    // COMPRAS
    Route::middleware(['rol:admin,gerente_compras'])
        ->prefix('compras') 
        ->group(function () {
            Route::resource('proveedores', ProveedorController::class);
          
            Route::resource('ordenes',CompraController::class);
        });

    // VENTAS
    Route::middleware(['rol:admin,gerente_ventas'])
        ->prefix('ventas')
        ->group(function () {
            Route::resource('clientes', ClientesController::class);
         
            Route::resource('facturas',FacturaController::class);
            Route::post('/facturas/{id}/aprobar', [FacturaController::class, 'aprobar'])
            ->name('facturas.aprobar');
        });
    //productos
    Route::middleware(['rol:admin,gerente_bodega,gerente_compras,gerente_ventas'])
    ->group(function () {
           Route::resource('productos', ProductoController::class);
    });

});

// Route::resource('facturas',FacturaController::class);

// Route::get('/admin/proveedores',[ProveedorController::class,'index'])->name('proveedores.index');
