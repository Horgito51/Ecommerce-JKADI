@extends('layouts.contentAdmin')
@section('content')
    <div class="mb-3 text-center">
        <h2>Editar Cliente {{ $clientes->id_cliente }}</h2>
    </div>
    <form action="{{ route('clientes.update', $clientes) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label ">Nombre * </label>
            <input type="text" class="form-control @error('cli_nombre') is-invalid @enderror" name="cli_nombre" 
            value="{{ old('cli_nombre', $clientes->cli_nombre) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label" value="">Tipo de documento* </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_documento" value="RUC"
                    {{ old('tipo_documento', strlen($clientes->cli_ruc_ced) == 13 ? 'RUC' : '') == 'RUC' ? 'checked' : '' }}>
                <label class="form-check-label">RUC</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_documento" value="CEDULA"
                    {{ old('tipo_documento', strlen($clientes->cli_ruc_ced) == 10 ? 'CEDULA' : '') == 'CEDULA' ? 'checked' : '' }}>
                <label class="form-check-label">Cédula</label>
            </div>
            @error('tipo_documento')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Cédula / RUC *</label>
            <input type="text" name="cli_ruc_ced" class="form-control @error('cli_ruc_ced') is-invalid @enderror" 
            value="{{ old('cli_ruc_ced', $clientes->cli_ruc_ced) }}" required>

            @error('cli_ruc_ced')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono * </label>
            <input type="text" class="form-control @error('cli_telefono') is-invalid @enderror" name="cli_telefono" 
            value="{{ old('cli_telefono', $clientes->cli_telefono) }}" required>
            @error('cli_telefono')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Ciudad * </label>
            <select name="ciudad_id" class="form-control @error('ciudad_id') is-invalid @enderror" required>
                <option value="">Seleccione una ciudad</option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" 
                        {{ old('ciudad_id', $clientes->ciudad_id ?? '') == $ciudad->id ? 'selected' : '' }}>
                        {{ $ciudad->ciu_descripcion }}
                    </option>
                @endforeach
            </select>
            @error('ciudad_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección * </label>
            <input type="text" class="form-control @error('cli_direccion') is-invalid @enderror" name="cli_direccion" 
            value="{{ old('cli_direccion', $clientes->cli_direccion) }}" required>
            @error('cli_direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email * </label>
            <input type="email" class="form-control @error('cli_email') is-invalid @enderror" name="cli_email" 
            value="{{ old('cli_email', $clientes->cli_email) }}" required>
            @error('cli_email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{route('clientes.index')}}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@endsection