<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Ciudades;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function validateCliente(Request $request, $id_cliente = null)
    {
        $rules = [
            'cli_nombre'   => 'required|string|max:50',
            'cli_telefono' => 'required|digits:10',
            'cli_direccion' => 'required|string|max:100',
            'ciudad_id'    => 'required|exists:ciudades,id',
            'cli_email'    => 'required|email|max:50',
            'tipo_documento' => 'required|in:CEDULA,RUC',
        ];

        $messages=[
            'cli_nombre.required' => 'El nombre del cliente es obligatorio',

            'tipo_documento.required' => 'Debe seleccionar un tipo de documento',
            'cli_ruc_ced.required' => 'El RUC o Cédula es obligatorio',
            'cli_ruc_ced.digits' => 'El número de documento no tiene la longitud correcta',
            'cli_ruc_ced.unique' => 'El RUC/Cédula ya está registrado',

            'cli_telefono.required' => 'El teléfono es obligatorio',
            'cli_telefono.digits' => 'El teléfono debe ser de 10 dígitos numéricos',

            'cli_direccion.required' => 'La dirección es obligatoria',

            'ciudad_id.required' => 'La ciudad es obligatoria',

            'cli_email.required' => 'El email es obligatorio',
            'cli_email.email' => 'El email debe ser una dirección de correo válida',
        ];

        if($request->tipo_documento === 'RUC'){
            $rules['cli_ruc_ced'] = 'digits:13';
            $rules['cli_ruc_ced'] .= '|unique:clientes,cli_ruc_ced';
        } else {
            $rules['cli_ruc_ced'] = 'digits:10';
            $rules['cli_ruc_ced'] .= '|unique:clientes,cli_ruc_ced';
        }

        if ($id_cliente !=null){
            $rules['cli_ruc_ced'] .= ',' . $id_cliente . ',id_cliente';
        }

        $request->validate($rules,$messages);
    }

    public function index(Request $request)
    {
        $clientes=Clientes::getClienteBy($request->search)
                        ->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {

        $ciudades=Ciudades::all();
        return view('clientes.create',compact('ciudades'));
    }

    public function store(Request $request)
    {
        $this->validateCliente($request);

        Clientes::createClientes([
            'cli_nombre'   => $request->cli_nombre,
            'cli_ruc_ced'  => $request->cli_ruc_ced,
            'cli_telefono' => $request->cli_telefono,
            'ciudad_id'    => $request->ciudad_id,
            'cli_direccion'=> $request->cli_direccion,
            'cli_email'    => $request->cli_email,
            'estado_cli'   => 'ACT',
        ]);

        return redirect()->route('clientes.index')
        ->with('success', 'Cliente creado exitosamente.');

    }

    public function edit(string $id_cliente)
    {
        $ciudades=Ciudades::all();
        $clientes = Clientes::getClienteById($id_cliente);
        return view('clientes.edit', compact('clientes','ciudades'));
    }

    public function update(Request $request, string $id_cliente)
    {
        $clientes = Clientes::getClienteById($id_cliente);

        $this->validateCliente($request, $clientes->id_cliente);

        Clientes::updateClientes($clientes->id_cliente, [
            'cli_nombre'   => $request->cli_nombre,
            'cli_ruc_ced'  => $request->cli_ruc_ced,
            'cli_telefono' => $request->cli_telefono,
            'ciudad_id'    => $request->ciudad_id,
            'cli_direccion'=> $request->cli_direccion,
            'cli_email'    => $request->cli_email,
        ]);

        return redirect()->route('clientes.index')
        ->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy(string $id_cliente)
    {
        $resultado=Clientes::destroyClientes($id_cliente);

        if (!$resultado) {
            return redirect()->route('clientes.index')
                ->with('error', 'No se puede eliminar el cliente porque tiene facturas asociadas.');
        }

        return redirect()->route('clientes.index')
        ->with('success', 'Cliente eliminado exitosamente.');
    }
}
