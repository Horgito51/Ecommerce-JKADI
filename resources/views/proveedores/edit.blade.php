{{-- VISTA: edit.blade.php --}}
@extends('layouts.contentAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <h3 class="mb-4">Editar Proveedor</h3>
            <form action="{{ route('proveedores.update', $proveedor->id_proveedor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">

                    {{-- NOMBRE --}}
                    <div class="col-12 col-md-8">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="prv_nombre" class="form-control @error('prv_nombre') is-invalid @enderror"
                               value="{{ old('prv_nombre', $proveedor->prv_nombre) }}" required>
                        @error('prv_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TIPO DE DOCUMENTO --}}
                    <div class="col-12 col-md-8" style="margin-top:5px">
                        <label class="form-label">Tipo de documento*</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_documento" value="RUC"
                            {{ old('tipo_documento', strlen($proveedor->prv_ruc_ced) == 13 ? 'RUC' : 'CEDULA') == 'RUC' ? 'checked' : '' }}>
                            <label class="form-check-label">RUC</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_documento" value="CEDULA"
                            {{ old('tipo_documento', strlen($proveedor->prv_ruc_ced) == 13 ? 'RUC' : 'CEDULA') == 'CEDULA' ? 'checked' : '' }}>
                            <label class="form-check-label">Cédula</label>
                        </div>
                        @error('tipo_documento')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- RUC / CÉDULA --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">RUC / Cédula</label>
                        <input type="text" name="prv_ruc_ced" class="form-control @error('prv_ruc_ced') is-invalid @enderror"
                               value="{{ old('prv_ruc_ced', $proveedor->prv_ruc_ced) }}" required>
                        @error('prv_ruc_ced')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="prv_mail" class="form-control @error('prv_mail') is-invalid @enderror"
                               value="{{ old('prv_mail', $proveedor->prv_mail) }}" required>
                        @error('prv_mail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TELÉFONO --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="prv_telefono" class="form-control @error('prv_telefono') is-invalid @enderror"
                               value="{{ old('prv_telefono', $proveedor->prv_telefono) }}">
                        @error('prv_telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- CELULAR --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Celular</label>
                        <input type="text" name="prv_celular" class="form-control @error('prv_celular') is-invalid @enderror"
                               value="{{ old('prv_celular', $proveedor->prv_celular) }}" required>
                        @error('prv_celular')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- CIUDAD --}}
                    <div class="col-12 col-md-6" style="margin:8px">
                        <label class="form-label">Ciudad</label>
                        <select name="id_ciudad" class="form-select rounded @error('id_ciudad') is-invalid @enderror" required>
                            @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}"
                                    {{ old('id_ciudad', $proveedor->id_ciudad) == $ciudad->id ? 'selected' : '' }}>
                                    {{ $ciudad->ciu_descripcion }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_ciudad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DIRECCIÓN --}}
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <textarea name="prv_direccion" class="form-control @error('prv_direccion') is-invalid @enderror"
                                  rows="3" required>{{ old('prv_direccion', $proveedor->prv_direccion) }}</textarea>
                        @error('prv_direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success" style="background-color:#198754;color:white">
                        Actualizar
                    </button>

                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary" style="background-color:#8C0606;color:white; margin:2px;">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
