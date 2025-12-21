@extends('layouts.contentAdmin')
@section('content')
    <h2>Lista de Clientes</h2>
    <div class="mb-3 gap-2 ">
        
        <a href="{{ route('clientes.create') }}" class="btn btn-success ml-auto">Agregar Cliente</a>
    </div>
    <div class="table-responsive">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>RUC/Cedula</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id_cliente }}</td>
                        <td>{{ $cliente->cli_nombre }}</td>
                        <td>{{ $cliente->cli_ruc_ced }}</td>
                        <td>{{ $cliente->cli_telefono }}</td>
                        <td>{{ $cliente->ciudades->ciu_descripcion }}</td>
                        <td>{{ $cliente->cli_direccion }}</td>
                        <td>{{ $cliente->cli_email }}</td>
                        <td>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')">
                                    Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
