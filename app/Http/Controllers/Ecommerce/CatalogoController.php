<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\View\View;


class CatalogoController extends Controller
{
    public function index(){
         $productos =Producto::getProductos();

        return view('Ecommerce.catalogo',compact('productos'));
    }
}
