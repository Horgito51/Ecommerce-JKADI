@extends('layouts.contentAdmin')
@section('content')
    <div class="mb-3 text-center">
        <h2>Editar Cliente {{ $clientes->id_cliente }}</h2>
    </div>
    <form action="{{ route('clientes.update', $clientes) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre * </label>
            <input type="text" class="form-control" name="cli_nombre" value="{{ $clientes->cli_nombre }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">RUC/Cédula * </label>
            <input type="text" class="form-control" name="cli_ruc_ced" value="{{ $clientes->cli_ruc_ced }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono * </label>
            <input type="text" class="form-control" name="cli_telefono" value ="{{ $clientes->cli_telefono }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ciudad * </label>
            <select name="ciudad_id" class="form-control" required>
                <option value="">Seleccione una ciudad</option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" {{ $clientes->ciudad_id == $ciudad->id ? 'selected' : '' }}>
                        {{ $ciudad->ciu_descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección * </label>
            <input type="text" class="form-control" name="cli_direccion" value="{{$clientes->cli_direccion}}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email * </label>
            <input type="email" class="form-control" name="cli_email" value="{{$clientes->cli_email}}" required>
        </div>
        <a href="{{route('clientes.index')}}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@endsection