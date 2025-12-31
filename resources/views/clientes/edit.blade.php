@extends('layouts.contentAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <h3 class="mb-4 text-center">
                Editar Cliente {{ $clientes->id_cliente }}
            </h3>

            <form action="{{ route('clientes.update', $clientes) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-12 col-md-8">
                        <label class="form-label">Nombre *</label>
                        <input type="text"
                               name="cli_nombre"
                               class="form-control @error('cli_nombre') is-invalid @enderror"
                               value="{{ old('cli_nombre', $clientes->cli_nombre) }}"
                               required>
                        @error('cli_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-8" style="margin-top:5px">
                        <label class="form-label">Tipo de documento *</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio"
                                   name="tipo_documento"
                                   value="RUC"
                                   {{ old('tipo_documento', strlen($clientes->cli_ruc_ced) == 13 ? 'RUC' : '') == 'RUC' ? 'checked' : '' }}>
                            <label class="form-check-label">RUC</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio"
                                   name="tipo_documento"
                                   value="CEDULA"
                                   {{ old('tipo_documento', strlen($clientes->cli_ruc_ced) == 10 ? 'CEDULA' : '') == 'CEDULA' ? 'checked' : '' }}>
                            <label class="form-check-label">Cédula</label>
                        </div>

                        @error('tipo_documento')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

    
                    <div class="col-12 col-md-6">
                        <label class="form-label">Cédula / RUC *</label>
                        <input type="text"
                               name="cli_ruc_ced"
                               class="form-control @error('cli_ruc_ced') is-invalid @enderror"
                               value="{{ old('cli_ruc_ced', $clientes->cli_ruc_ced) }}"
                               required>
                        @error('cli_ruc_ced')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Teléfono *</label>
                        <input type="text"
                               name="cli_telefono"
                               class="form-control @error('cli_telefono') is-invalid @enderror"
                               value="{{ old('cli_telefono', $clientes->cli_telefono) }}"
                               required>
                        @error('cli_telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Ciudad *</label>
                        <select name="ciudad_id" class="form-control @error('ciudad_id') is-invalid @enderror"  required>
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

                    <div class="col-12">
                        <label class="form-label">Dirección *</label>
                        <input type="text"
                               name="cli_direccion"
                               class="form-control @error('cli_direccion') is-invalid @enderror"
                               value="{{ old('cli_direccion', $clientes->cli_direccion) }}"
                               required>
                        @error('cli_direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email"
                               name="cli_email"
                               class="form-control @error('cli_email') is-invalid @enderror"
                               value="{{ old('cli_email', $clientes->cli_email) }}"
                               required>
                        @error('cli_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="mt-4 d-flex gap-2">
                    <button type="submit"
                            class="btn btn-success"
                            style="background-color:#198754;color:white">
                        Actualizar
                    </button>

                    <a href="{{ route('clientes.index') }}"
                       class="btn btn-secondary"
                       style="background-color:#8C0606;color:white;">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
