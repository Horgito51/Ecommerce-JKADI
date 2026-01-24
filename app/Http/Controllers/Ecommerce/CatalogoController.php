<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\tiposProducto;
use Illuminate\View\View;


class CatalogoController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $categoria = $request->input('categoria');
        $productos =Producto::getProductoEcommerceBy($search, $categoria);
        $categorias=tiposProducto::getAllTiposProducto();
        return view('Ecommerce.catalogo',compact('productos','categorias'));
    }

    public function show($id){
        $producto = Producto::with('tipoProducto')
            ->where('id_producto', $id)
            ->firstOrFail();

        $productosRelacionados = Producto::getRelatedProducts($producto->id_tipo, $producto->id_producto);

        return view('Ecommerce.detalle', compact('producto', 'productosRelacionados'));
    }



}
