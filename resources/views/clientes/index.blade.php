@extends('layouts.contentAdmin')
@section('content')
    <h2>Lista de Clientes</h2>
    <div class="mb-3 gap-2 ">

        <a href="{{ route('clientes.create') }}" class="btn btn-success ml-auto">Agregar Cliente</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead style="background-color:#031832; color:white;">
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
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm"
                                    style="background-color:#031832;color:white; margin:2px;
                                            padding: 4px 10px;
                                            font-size: 0.8rem;
                                            min-width: 65px;">
                                    Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm"
                                        style="padding: 4px 10px; background-color:#8C0606;color:white; margin:2px;
                                            font-size: 0.8rem;
                                            min-width: 65px;"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este Proveedor?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
