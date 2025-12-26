<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Ciudades;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores=Proveedor::getProveedores();
        return view('proveedores.index',compact('proveedores'));
    }

    public function create()
    {
        $ciudades=Ciudades::getCiudades();
        return view('proveedores.create',compact('ciudades'));
    }

    public function store(Request $request)
    {
        $this->validateProveedor($request);
        Proveedor::createProveedor($request);
        return redirect()->route('proveedores.index')->with('success','El proveedor se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        $ciudades=Ciudades::getCiudades();
        $proveedor=Proveedor::getProveedorById($proveedor->id_proveedor);
        return view('proveedores.edit',data: compact('proveedor','ciudades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
private function validateProveedor(Request $request)
{

    $request->validate([
        'prv_nombre'   => 'required|string|max:40',
        'prv_ruc_ced'  => 'required|string|max:13|unique:proveedores,prv_ruc_ced',
        'prv_telefono' => 'nullable|string|max:10',
        'prv_mail'     => 'required|email|max:60',
        'id_ciudad'    => 'required|exists:ciudades,id',
        'prv_celular'  => 'required|string|max:10',
        'prv_direccion'=> 'required|string|max:60',
    ]);
}

}
