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

    // public function show(Proveedor $proveedor)
    // {
    //     //
    // }

    public function edit(String $id)
    {
        $ciudades=Ciudades::getCiudades();
        $proveedor=Proveedor::getProveedorById($id);
        return view('proveedores.edit',data: compact('proveedor','ciudades'));
    }

    public function update(Request $request, string $id)
    {
        $this->validateProveedor($request);
        Proveedor::updateProveedor($id,[
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
        ->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $eliminado=Proveedor::destroyProveedor($id);
        if(!$eliminado){
        return redirect()
        ->route('proveedores.index')
        ->with('fail', 'Proveedor con compras activas, error al eliminar.');
        }
        return redirect()
        ->route('proveedores.index')
        ->with('success', 'Proveedor eliminado ');
    }
private function validateProveedor(Request $request, $id_proveedor = null)
{
    $rules = [
        'prv_nombre'    => 'required|string|max:40',
        'prv_telefono'  => 'nullable|string|min:10|max:10|regex:/^[0-9]+$/',
        'prv_mail'      => 'required|email|max:60',
        'id_ciudad'     => 'required|exists:ciudades,id',
        'prv_celular'   => 'required|string|min:10|max:10|regex:/^[0-9]+$/',
        'prv_direccion' => 'required|string|max:60',
        'tipo_documento' => 'required|in:RUC,CEDULA',
    ];

    $messages = [
        'prv_nombre.required' => 'El nombre del proveedor es obligatorio',
        'prv_nombre.max' => 'El nombre no puede exceder 40 caracteres',

        'tipo_documento.required' => 'Debe seleccionar un tipo de documento',
        'tipo_documento.in' => 'El tipo de documento debe ser RUC o Cédula',

        'prv_ruc_ced.required' => 'El RUC o Cédula es obligatorio',
        'prv_ruc_ced.digits' => 'El número de documento no tiene la longitud correcta',
        'prv_ruc_ced.unique' => 'El RUC/Cédula ya está registrado',
        'prv_ruc_ced.regex'=>'El RUC/Cédula debe contener solo números ',

        'prv_telefono.min' => 'El teléfono debe contener 10 dígitos',
        'prv_telefono.max' => 'El teléfono no puede exceder 10 dígitos',
        'prv_telefono.regex' => 'El teléfono debe contener solo números',

        'prv_celular.required' => 'El celular es obligatorio',
        'prv_celular.min' => 'El celular debe contener 10 dígitos',
        'prv_celular.max' => 'El celular no puede exceder 10 dígitos',
        'prv_celular.regex' => 'El celular debe contener solo números',

        'prv_mail.required' => 'El email es obligatorio',
        'prv_mail.email' => 'El email debe ser una dirección de correo válida',
        'prv_mail.max' => 'El email no puede exceder 60 caracteres',

        'id_ciudad.required' => 'La ciudad es obligatoria',
        'id_ciudad.exists' => 'La ciudad seleccionada no es válida',

        'prv_direccion.required' => 'La dirección es obligatoria',
        'prv_direccion.max' => 'La dirección no puede exceder 60 caracteres',
    ];

    if ($request->tipo_documento === 'RUC') {
        $rules['prv_ruc_ced'] = 'required|digits:13|regex:/^[0-9]+$/';
    } else {
        $rules['prv_ruc_ced'] = 'required|digits:10|regex:/^[0-9]+$/';
    }
    if ($id_proveedor != null) {
        $rules['prv_ruc_ced'] .= '|unique:proveedores,prv_ruc_ced,' . $id_proveedor . ', id_proveedor';
        //   $rules['cli_ruc_ced'] .= ',' . $id_cliente . ',id_cliente';
    }

    $request->validate($rules, $messages);
}

}
