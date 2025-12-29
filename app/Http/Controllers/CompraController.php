<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function index()
    {
        $compras=Compra::getCompras();
        return view('compras.index',compact('compras'));
    }
    public function create()
    {
        $proveedores=Proveedor::getProveedores();
        $productos=Producto::getAllProductos();
        return view('compras.create',compact('proveedores','productos'));
    }
    public function store(Request $request)
    {
        echo('hola');
    }

    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Compra $compra)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }

    public function validateCompra($request){
        $rules = [
        'id_proveedor' => 'required|exists:proveedores,id_proveedor',

        'oc_subtotal' => 'required|numeric|min:0.01',
        'oc_iva'      => 'required|numeric|min:0',
        'oc_total'    => 'required|numeric|min:0.01',
    ];

    $messages = [
        'id_proveedor.required' => 'Debe seleccionar un proveedor',
        'id_proveedor.exists'   => 'El proveedor seleccionado no es válido',

        'oc_subtotal.required' => 'El subtotal es obligatorio',
        'oc_subtotal.numeric'  => 'El subtotal debe ser un valor numérico',
        'oc_subtotal.min'      => 'El subtotal debe ser mayor a cero',

        'oc_iva.required' => 'El IVA es obligatorio',
        'oc_iva.numeric'  => 'El IVA debe ser un valor numérico',
        'oc_iva.min'      => 'El IVA no puede ser negativo',

        'oc_total.required' => 'El total es obligatorio',
        'oc_total.numeric'  => 'El total debe ser un valor numérico',
        'oc_total.min'      => 'El total debe ser mayor a cero',
    ];

    $request->validate($rules, $messages);

    }
}
