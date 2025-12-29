<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Factura;
use Illuminate\Http\Request;
use App\Models\Producto;

class FacturaController extends Controller
{

    public function validateFactura($request)
    {
        $rules = [
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'fac_descripcion' => 'required|string|max:255',
            'fac_subtotal'  => 'required|numeric|min:0.01',
            'fac_iva'       => 'required|numeric|min:0.000001',
            'fac_total'     => 'required|numeric|min:0.01',

            'productos' => 'required|array|min:1',

            'productos.*.id_producto'  => 'required|exists:productos,id_producto',
            'productos.*.pxf_cantidad' => 'required|integer|min:1',

        ];

        $messages = [
            'id_cliente.required' => 'Debe seleccionar un cliente',
            'id_cliente.exists'   => 'El cliente seleccionado no es válido',

            'fac_descripcion.required' => 'La descripción es obligatoria',
            'fac_descripcion.string'   => 'La descripción debe ser una cadena de texto',

            'fac_subtotal.required' => 'El subtotal es obligatorio',
            'fac_subtotal.numeric'  => 'El subtotal debe ser un valor numérico',
            'fac_subtotal.min'      => 'El subtotal debe ser mayor a cero',

            'fac_iva.required' => 'El IVA es obligatorio',
            'fac_iva.numeric'  => 'El IVA debe ser un valor numérico',
            'fac_iva.min'      => 'El IVA no puede ser negativo',

            'fac_total.required' => 'El total es obligatorio',
            'fac_total.numeric'  => 'El total debe ser un valor numérico',
            'fac_total.min'      => 'El total debe ser mayor a cero',

            'productos.required' => 'Debe agregar al menos un producto',
            'productos.min'      => 'Debe agregar al menos un producto',

            'productos.*.id_producto.required' => 'Debe seleccionar un producto',
            'productos.*.id_producto.exists'   => 'Producto no válido',

            'productos.*.pxf_cantidad.required' => 'La cantidad es obligatoria',
            'productos.*.pxf_cantidad.integer'  => 'La cantidad debe ser un número entero',
            'productos.*.pxf_cantidad.min'      => 'La cantidad debe ser mayor a cero',
        ];

        $request->validate($rules, $messages);
    }

    public function index()
    {
        $facturas = Factura::getFacturas();
        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Clientes::getClientes();
        $productos = Producto::getAllProductos();
        return view('facturas.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateFactura($request);
        $data = [
            'id_cliente' => $request->id_cliente,
            'fac_descripcion' => $request->fac_descripcion,
            'fac_subtotal'  => $request->fac_subtotal,
            'fac_iva'       => $request->fac_iva,
            'fac_total'     => $request->fac_total,
            'productos'    => $request->productos,
        ];


        Factura::createFactura($data);
        return redirect()
            ->route('facturas.index')
            ->with('success', 'Factura creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $factura = Factura::getFacturaById($id);
        $clientes = Clientes::getClientes();
        $productos = Producto::getAllProductos();
        return view('facturas.edit', compact('factura', 'clientes', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateFactura($request);
        
        $data = [
            'id_cliente' => $request->id_cliente,
            'fac_descripcion' => $request->fac_descripcion,
            'fac_subtotal'  => $request->fac_subtotal,
            'fac_iva'       => $request->fac_iva,
            'fac_total'     => $request->fac_total,
            'productos'    => $request->productos,
        ];
        Factura::updateFacturas($id, $data);
        return redirect()
            ->route('facturas.index')
            ->with('success', 'Factura actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
