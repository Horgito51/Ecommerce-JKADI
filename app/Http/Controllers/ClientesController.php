<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Ciudades;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
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
        $request->validate([
            'id_cliente'   => 'required|string|max:15|unique:clientes,id_cliente',
            'cli_nombre'   => 'required|string|max:50',
            'cli_ruc_ced'  => 'required|string|max:13|unique:clientes,cli_ruc_ced',
            'cli_telefono' => 'required|string|max:15',
            'ciudad_id'    => 'required|exists:ciudades,id',
            'cli_email'    => 'required|email|max:50',
        ]);

        Clientes::create([
            'id_cliente' => trim($request->id_cliente),
            'cli_nombre' => $request->cli_nombre,
            'cli_ruc_ced' => $request->cli_ruc_ced,
            'cli_telefono' => $request->cli_telefono,
            'ciudad_id' => $request->ciudad_id,
            'cli_direccion' => $request->cli_direccion,
            'cli_email' => $request->cli_email,
            'estado_cli' => 'ACT',
        ]);

        return redirect()->route('clientes.index')
        ->with('success', 'Cliente creado exitosamente.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_cliente)
    {
        $ciudades=Ciudades::all();
        $clientes = Clientes::where('id_cliente', trim($id_cliente))->firstOrFail();
        return view('clientes.edit', compact('clientes','ciudades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_cliente)
    {
        $clientes = Clientes::where('id_cliente', trim($id_cliente))->firstOrFail();
        
        $request->validate([
            'cli_nombre' => 'required',
            'cli_ruc_ced' => 'required|string|max:13|unique:clientes,cli_ruc_ced,'.$clientes->id_cliente.',id_cliente',
            'cli_telefono' => 'required|string|max:10',
            'ciudad_id' => 'required',
            'cli_email' => 'required|email',
        ]);

        $clientes->update([
            'cli_nombre' => $request->cli_nombre,
            'cli_ruc_ced' => $request->cli_ruc_ced,
            'cli_telefono' => $request->cli_telefono,
            'ciudad_id' => $request->ciudad_id,
            'cli_direccion' => $request->cli_direccion,
            'cli_email' => $request->cli_email,
        ]);

        return redirect()->route('clientes.index')
        ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_cliente)
    {
        $clientes=Clientes::where('id_cliente', trim($id_cliente))->firstOrFail();
        $clientes->estado_cli='INA';
        $clientes->save();
        return redirect()->route('clientes.index')
        ->with('success', 'Cliente eliminado exitosamente.');
    }
}
