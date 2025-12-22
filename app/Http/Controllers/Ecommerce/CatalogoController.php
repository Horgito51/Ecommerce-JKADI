<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\tiposProducto;
use Illuminate\View\View;


class CatalogoController extends Controller
{
    public function index(){
         $productos =Producto::getProductos();
        $categorias=tiposProducto::getAllTiposProducto();
        return view('Ecommerce.catalogo',compact('productos','categorias'));
    }

    public function show($id){
        $producto = Producto::with('tipoProducto')
            ->where('id_producto', $id)
            ->firstOrFail();
        
        return view('Ecommerce.detalle', compact('producto'));
    }

    

}
