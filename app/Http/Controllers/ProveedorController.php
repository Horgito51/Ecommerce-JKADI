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

    Proveedor::createProveedor([
        'prv_nombre'     => $request->prv_nombre,
        'prv_ruc_ced'    => $request->prv_ruc_ced,
        'prv_telefono'   => $request->prv_telefono,
        'prv_mail'       => $request->prv_mail,
        'id_ciudad'      => $request->id_ciudad,
        'prv_celular'    => $request->prv_celular,
        'prv_direccion'  => $request->prv_direccion,
    ]);

    return redirect()
        ->route('proveedores.index')
        ->with('success', 'Proveedor creado exitosamente.');
}

    public function show(Proveedor $proveedor)
    {
        //
    }

    public function edit(String $id)
    {
        $ciudades=Ciudades::getCiudades();
        $proveedor=Proveedor::getProveedorById($id);
        return view('proveedores.edit',data: compact('proveedor','ciudades'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {

    }

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
