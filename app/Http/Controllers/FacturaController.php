<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Factura;
use Illuminate\Http\Request;
use App\Models\Producto;
class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas= Factura::getFacturas();
        return view('facturas.index',compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Clientes::getClientes();
        $productos=Producto::getAllProductos();

        return view('facturas.create',compact('clientes','productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
