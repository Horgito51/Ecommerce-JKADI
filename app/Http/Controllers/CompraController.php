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
    $this->validateCompra($request);

    $data = [
        'id_proveedor' => $request->id_proveedor,
        'oc_subtotal'  => $request->oc_subtotal,
        'oc_iva'       => $request->oc_iva,
        'oc_total'     => $request->oc_total,
        'productos'    => $request->productos,
    ];
    Compra::createCompra($data);
    return redirect()
        ->route('ordenes.index')
        ->with('success', 'Orden de compra creada exitosamente');
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
        $compra=Compra::getComprasById($id);
        $proveedores=Proveedor::getProveedores();
        $productos=Producto::getAllProductos();
        return view('compras.edit',compact('compra','proveedores','productos'));
    }

    public function update(Request $request, string $id)
    {
        $this->validateCompra($request);

        $data = [
            'id_proveedor' => $request->id_proveedor,
            'oc_subtotal'  => $request->oc_subtotal,
            'oc_iva'       => $request->oc_iva,
            'oc_total'     => $request->oc_total,
            'productos'    => $request->productos,
        ];

        Compra::updateCompra($id, $data);
        return redirect()
            ->route('ordenes.index')
            ->with('success', 'Orden de compra actualizada exitosamente');
    }
    public function destroy(string $id)
    {
        Compra::destroyCompra($id);
        return redirect()
        ->route('ordenes.index')
        ->with('success', 'Orden de compra anulada correctamente');
    }

    public function validateCompra($request){
        $rules = [
        'id_proveedor' => 'required|exists:proveedores,id_proveedor',

        'oc_subtotal' => 'required|numeric|min:0.01',
        'oc_iva'      => 'required|numeric|min:0',
        'oc_total'    => 'required|numeric|min:0.01',
        'productos' => 'required|array|min:1',

        'productos.*.id_producto'  => 'required|exists:productos,id_producto',
        'productos.*.pxo_cantidad' => 'required|integer|min:1',
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

        'productos.required' => 'Debe agregar al menos un producto',
        'productos.array'    => 'El formato de productos no es válido',
        'productos.min'      => 'Debe agregar al menos un producto',

        'productos.*.id_producto.required' => 'Debe seleccionar un producto',
        'productos.*.id_producto.exists'   => 'Producto no válido',

        'productos.*.pxo_cantidad.required' => 'La cantidad es obligatoria',
        'productos.*.pxo_cantidad.integer'  => 'La cantidad debe ser un número entero',
        'productos.*.pxo_cantidad.min'      => 'La cantidad debe ser mayor a cero',
    ];

    $request->validate($rules, $messages);

    }
}
