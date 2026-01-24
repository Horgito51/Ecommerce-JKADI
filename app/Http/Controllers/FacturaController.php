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

    private function validarStock(array $productos){
        foreach ($productos as $item){
            $producto=Producto::getProductoById($item['id_producto']);

            if(!$producto){
                abort(422, 'Producto no encontrado');
            }

            if($item['pxf_cantidad'] > $producto->pro_saldo_final){
                return "Stock insuficiente para el producto {$producto->pro_descripcion}. Disponible: {$producto->pro_saldo_final}";
            }
        }
        return null;
    }

    public function index(Request $request)
    {
        $facturas = Factura::getFacturaBy($request->search)->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Clientes::getClientes();
        $productos = Producto::getAllProductosFacturas();
        return view('facturas.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateFactura($request);
        $errorStock = $this->validarStock($request->productos);


        if ($errorStock) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $errorStock);
        }
        Factura::createFactura([
            'id_cliente' => $request->id_cliente,
            'fac_descripcion' => $request->fac_descripcion,
            'fac_subtotal'  => $request->fac_subtotal,
            'fac_iva'       => $request->fac_iva,
            'fac_total'     => $request->fac_total,
            'productos'    => $request->productos,
        ]);



        return redirect()
            ->route('facturas.index')
            ->with('success', 'Factura creada exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $factura = Factura::getFacturaById($id);
        $clientes = Clientes::getClientes();
        $productos = Producto::getAllProductosFacturas();
        $productosFactura=$factura->productos;
        return view('facturas.edit', compact('factura', 'clientes', 'productos','productosFactura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateFactura($request);

        $errorStock = $this->validarStock($request->productos);


        if ($errorStock) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $errorStock);
        }

        Factura::updateFacturas($id, [
            'id_cliente' => $request->id_cliente,
            'fac_descripcion' => $request->fac_descripcion,
            'fac_subtotal'  => $request->fac_subtotal,
            'fac_iva'       => $request->fac_iva,
            'fac_total'     => $request->fac_total,
            'productos'    => $request->productos,
        ]);
        return redirect()
            ->route('facturas.index')
            ->with('success', 'Factura actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_factura)
    {
        Factura::destroyFacturas($id_factura);
        return redirect()
            ->route('facturas.index')
            ->with('success', 'Factura anulada exitosamente');

    }

    public function aprobar (string $id_factura){
        Factura::aprobarFactura($id_factura);
        return redirect()
        ->route('facturas.index')
        ->with('success', 'Factura aprobada correctamente');
    }
}
