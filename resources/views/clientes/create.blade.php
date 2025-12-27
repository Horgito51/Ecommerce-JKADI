@extends('layouts.contentAdmin')
@section('content')
    <div class="mb-3 text-center">
        <h2>Registrar Nuevo Cliente</h2>
    </div>

    <form action="{{route('clientes.store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre * </label>
            <input type="text" class="form-control @error('cli_nombre') is-invalid @enderror " value="{{old('cli_nombre')}}" name="cli_nombre" required>
            @error('cli_nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de documento* </label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_documento" value="RUC" 
                {{ old('tipo_documento', 'RUC') == 'RUC' ? 'checked' : '' }}>
                <label class="form-check-label">RUC</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_documento" value="CEDULA" 
                {{ old('tipo_documento', 'CEDULA') == 'CEDULA' ? 'checked' : '' }}>
                <label class="form-check-label">Cédula</label>
            </div>
            @error('tipo_documento')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Cédula / RUC *</label>
            <input type="text" name="cli_ruc_ced" class="form-control @error('cli_ruc_ced') is-invalid @enderror" value="{{ old('cli_ruc_ced') }}" required>

            @error('cli_ruc_ced')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono * </label>
            <input type="text" class="form-control @error('cli_telefono') is-invalid @enderror" value=" {{old('cli_telefono')}}" name="cli_telefono" required>
            @error('cli_telefono')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Ciudad * </label>
            <select name="ciudad_id" class="form-control @error('ciudad_id') is-invalid @enderror"  required>
                <option value="">Seleccione una ciudad</option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}" 
                        {{ old('ciudad_id') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->ciu_descripcion }}</option>
                @endforeach
            </select>
            @error('ciudad_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección * </label>
            <input type="text" class="form-control @error('cli_direccion') is-invalid @enderror " value="{{old('cli_direccion')}}" name="cli_direccion" required>
            @error('cli_direccion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email * </label>
            <input type="email" class="form-control @error('cli_email') is-invalid @enderror " value="{{old('cli_email')}}" name="cli_email" required>
            @error('cli_email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{route('clientes.index')}}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
    
@endsection
