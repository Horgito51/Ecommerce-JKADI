@extends('layouts.contentAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <h3 class="mb-4">Registrar Proveedor</h3>

            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- NOMBRE --}}
                    <div class="col-12 col-md-8">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="prv_nombre" class="form-control" placeholder="Nombre del proveedor" required>
                    </div>

                    {{-- RUC / CÉDULA --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">RUC / Cédula</label>
                        <input type="text" name="prv_ruc_ced" class="form-control" required>
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="prv_mail" class="form-control" required>
                    </div>

                    {{-- TELÉFONO --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="prv_telefono" class="form-control">
                    </div>

                    {{-- CELULAR --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Celular</label>
                        <input type="text" name="prv_celular" class="form-control" required>
                    </div>

                    {{-- CIUDAD --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label">Ciudad</label>
                        <select name="id_ciudad" class="form-select" required>
                            <option value="" disabled selected >Seleccione una ciudad</option>
                            @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}">
                                    {{ $ciudad->ciu_descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- DIRECCIÓN --}}
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <textarea name="prv_direccion" class="form-control" rows="3" required></textarea>
                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>

                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
