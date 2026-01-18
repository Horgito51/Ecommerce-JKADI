<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortadaController extends Controller
{
public function index()
{
    $categorias = [

        [
            'id' => 'BEB',
            'nombre' => 'Bebidas y Chocolates',
            'svg' => '
                 <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                 fill="currentColor" viewBox="0 0 24 24" style="color:#031832">
                                <path d="M6 2h12l-1 20H7L6 2zm2 4v2h8V6H8z"/>
                            </svg>'
        ],

        [
            'id' => 'CAR',
            'nombre' => 'Cárnicos y Embutidos',
            'svg' => '
                 <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                 fill="currentColor" viewBox="0 0 24 24" style="color:#031832">
                                <path d="M4 10c0-4 4-6 8-6s8 2 8 6-4 8-8 8-8-4-8-8z"/>
                            </svg>'
        ],

        [
            'id' => 'CON',
            'nombre' => 'Condimentos y Aceites',
            'svg' => '
                 <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                 viewBox="0 0 64 64" fill="currentColor" style="color:#031832">
                                <path d="M38 6h8v6l4 4v36c0 3-2 6-6 6H34c-4 0-6-3-6-6V16l4-4V6z"/>
                            </svg>'
        ],

        [
            'id' => 'GAL',
            'nombre' => 'Panadería y Galletas',
            'svg' => '
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                 fill="currentColor" viewBox="0 0 24 24" style="color:#031832">
                                <path d="M4 12c0-4 4-8 8-8s8 4 8 8-4 8-8 8z"/>
                            </svg>'
        ],

        [
            'id' => 'GRN',
            'nombre' => 'Granos y Cereales',
            'svg' => '
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                 viewBox="0 0 64 64" fill="none" stroke="currentColor"
                                 stroke-width="3" style="color:#031832">
                                <path d="M18 8h28l-2 6v38a4 4 0 0 1-4 4H24a4 4 0 0 1-4-4V14l-2-6z"/>
                            </svg>'
        ],

        [
            'id' => 'HEL',
            'nombre' => 'Lácteos y Refrigerados',
            'svg' => '
                 <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                 fill="currentColor" viewBox="0 0 24 24" style="color:#031832">
                                <path d="M6 2h12v20H6z"/>
                            </svg>'
        ],

        [
            'id' =>'OTR',
            'nombre' => 'Limpieza e Higiene',
            'svg' => '
                 <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                 fill="currentColor" viewBox="0 0 24 24" style="color:#031832">
                                <path d="M8 2h8v4H8zm-2 6h12l-1 14H7z"/>
                            </svg>'
        ],

    ];

    return view('Ecommerce.dashboard', compact('categorias'));
}

}
