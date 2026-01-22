<?php

use App\Http\Controllers\Ecommerce\CatalogoController;
use App\Http\Controllers\Ecommerce\CarritoController;
use App\Models\Producto;
use App\Http\Controllers\Ecommerce\PortadaController;
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
//Intento de registro
use App\Http\Controllers\RegisterController;
//pasarela de pago
use App\Http\Controllers\CheckoutController;

Route::get('/portada',  [PortadaController::class,'index'])->name('portada.index');


// ECOMMERCE
Route::get('/', function () {

    return redirect()->route('portada.index');
});

Route::group([],function(){
    Route::get('/carrito',[CarritoController::class,'index'])->name('carrito.index');
    // Endpoints para el sidebar / acciones del carrito
    Route::get('/carrito/data', [CarritoController::class, 'show'])->name('carrito.show');
    Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
    Route::patch('/carrito/update', [CarritoController::class, 'update'])->name('carrito.update');
    Route::delete('/carrito/remove/{id_producto}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::delete('/carrito/clear', [CarritoController::class, 'clear'])->name('carrito.clear');
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
            })->name('bodega.index');;

        });

    // COMPRAS
    Route::middleware(['rol:admin,gerente_compras'])
        ->prefix('compras')
        ->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard');
            })->name('compras.index');;
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
            })->name('ventas.index');;

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

//Registro de usuario
Route::controller(RegisterController::class)->group(function () {

    /*
    | Paso 1 – Verificación de documento
    */

    // Mostrar pantalla: cédula / RUC
    Route::get('/register/step-1', 'step1')
        ->name('register.step1');

    // Procesar documento y decidir flujo
    Route::post('/register/step-1', 'step1Check')
        ->name('register.step1.check')
        ->middleware('throttle:10,1'); // opcional recomendado


    /*
    | Paso 2A – Cliente si existe pero no tiene cuenta
    */

    // Mostrar formulario: email + contraseña
    Route::get('/register/existing', 'existingForm')
        ->name('register.existing.form');

    // Crear user y asociar al cliente existente
    Route::post('/register/existing', 'storeExisting')
        ->name('register.existing.store');


    /*
    | Paso 2B – Cliente NO existe indica el formulario completo
    */

    // Formulario completo (reusa tu blade actual)
    Route::get('/register', 'form')
        ->name('register.form');

    // Procesar registro completo
    Route::post('/register', 'store')
        ->name('register.store');


    /*
    | Endpoint opcional (AJAX) – verificación segura para ya no devuolver datos personales
    */

    Route::post('/register/verificar', 'verificarCliente')
        ->name('register.verificar')
        ->middleware('throttle:10,1');
});

//rutas de pasarela de pago
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


Route::post('/checkout/proceder', [CheckoutController::class, 'proceed'])
    ->name('checkout.proceed'); // botón "proceder al pago"