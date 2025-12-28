@extends('layouts.contentAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <h3 class="mb-4">Editar Proveedor</h3>

            <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">

                    {{-- NOMBRE --}}
                    <div class="col-12 col-md-8">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="prv_nombre" class="form-control"
                               value="{{ $proveedor->prv_nombre }}" required>
                    </div>

                    {{-- RUC / CÉDULA --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">RUC / Cédula</label>
                        <input type="text" name="prv_ruc_ced" class="form-control"
                               value="{{ $proveedor->prv_ruc_ced }}" required>
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="prv_mail" class="form-control"
                               value="{{ $proveedor->prv_mail }}" required>
                    </div>

                    {{-- TELÉFONO --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="prv_telefono" class="form-control"
                               value="{{ $proveedor->prv_telefono }}">
                    </div>

                    {{-- CELULAR --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Celular</label>
                        <input type="text" name="prv_celular" class="form-control"
                               value="{{ $proveedor->prv_celular }}" required>
                    </div>

                    {{-- CIUDAD --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Ciudad</label>
                        <select name="id_ciudad" class="form-select rounded " required>
                            @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}"
                                    {{ $proveedor->id_ciudad == $ciudad->id ? 'selected' : '' }}>
                                    {{ $ciudad->ciu_descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DIRECCIÓN --}}
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <textarea name="prv_direccion" class="form-control" rows="3" required>{{ $proveedor->prv_direccion }}</textarea>
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
