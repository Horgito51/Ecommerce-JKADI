<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['rol:gerente_bodega'])
    ->prefix('backoffice')
    ->group(function () {

        Route::get('/', function () {
            return 'Backoffice funcionando 🚀';
        });

    });
