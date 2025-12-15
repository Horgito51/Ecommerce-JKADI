<?php

use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;


route::get('/', function () {
    return view('welcome');
});

Route::prefix('products')->controller(ProductController::class)->group(function () {

        Route::get('/', 'index')->name('products.index');
        Route::post('/', 'store')->name('products.store');
        Route::get('/edit', 'edit')->name('products.edit');
        Route::get('/{id}', 'show')->name('products.show');
        Route::put('/{id}', 'update')->name('products.update');
        Route::put('/{id}', 'destroy')->name('products.destroy');

});