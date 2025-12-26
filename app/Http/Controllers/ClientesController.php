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
        ];

        if ($id_cliente ===null){
            $rules ['id_cliente']='required|string:max:10|unique:clientes,id_cliente';
            $rules ['cli_ruc_ced'] = 'required|digits_between:10,13|unique:clientes,cli_ruc_ced';
        } else{
            $rules ['cli_ruc_ced'] = 'required|digits_between:10,13|unique:clientes,cli_ruc_ced,'.$id_cliente.',id_cliente';
        }

        $request->validate($rules);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes=Clientes::getClientes();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $ciudades=Ciudades::all();
        return view('clientes.create',compact('ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $this->validateCliente($request);

        Clientes::createClientes([
            'id_cliente'   => $request->id_cliente,
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_cliente)
    {
        $ciudades=Ciudades::all();
        $clientes = Clientes::getClienteById($id_cliente);
        return view('clientes.edit', compact('clientes','ciudades'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
