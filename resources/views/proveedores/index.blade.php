@php
    $searchRoute = route('proveedores.index');
    $searchPlaceholder = 'Buscar por ID, nombre o RUC/Cédula';
    $searchExtraParams = []; // si luego agregas filtros, aquí los mantienes
@endphp

@extends('layouts.contentAdmin')

@section('content')

@push('styles')
<style>
    @media (max-width: 576px) {
        th.col-detalle, td.col-detalle { display: none !important; }
    }

    .fila-detalle { display:none; background:#f8f9fa; }
    .fila-detalle .detalle-box{
        padding: 10px 12px;
        border: 1px solid #031832;
        border-radius: 8px;
        text-align: left;
        color: #031832;
    }
    .detalle-item span{ font-weight: 600; }
</style>
@endpush

<h2 class="mb-3" style="color:#031832">Lista de Proveedores</h2>

<div class="d-flex flex-column flex-sm-row gap-2 mb-3">
    <a href="{{ route('proveedores.create') }}"
       class="btn d-block d-sm-inline-block"
       style="background-color:#198754;color:white">
        Crear
    </a>
</div>

<div class="table-responsive-sm">
    <table class="table table-bordered align-middle">
        <thead style="background-color:#031832;color:white">
        <tr class="text-center">
            <th>ID</th>
            <th>Nombre</th>

            <th class="col-detalle">RUC/Cédula</th>
            <th class="col-detalle">Teléfono</th>
            <th class="col-detalle">Email</th>
            <th class="col-detalle">Ciudad</th>
            <th class="col-detalle">Celular</th>
            <th class="col-detalle">Dirección</th>

            <th>Acciones</th>
        </tr>
        </thead>

        <tbody style="color:#031832;border-color:#031832">
        @foreach ($proveedores as $proveedor)
            <tr class="text-center {{ $loop->odd ? 'fila-zebra' : '' }}">
                <td>{{ $proveedor->id_proveedor }}</td>

                <td class="text-start">
                    {{ $proveedor->prv_nombre }}
                </td>

                <td class="col-detalle">{{ $proveedor->prv_ruc_ced }}</td>
                <td class="col-detalle">{{ $proveedor->prv_telefono }}</td>
                <td class="col-detalle">{{ $proveedor->prv_mail }}</td>
                <td class="col-detalle">{{ $proveedor->ciudades->ciu_descripcion ?? '-' }}</td>
                <td class="col-detalle">{{ $proveedor->prv_celular }}</td>
                <td class="col-detalle">{{ $proveedor->prv_direccion }}</td>

                <td>
                    <div class="d-flex flex-column flex-md-row gap-1 justify-content-center acciones-botones">

                        {{-- Hamburguesa SOLO en celular --}}
                        <button type="button"
                                class="btn btn-sm d-sm-none btn-hamburguesa"
                                onclick="toggleDetalle('{{ $proveedor->id_proveedor }}')">
                            ☰
                        </button>

                        <a href="{{ route('proveedores.edit', $proveedor->id_proveedor) }}"
                           class="btn btn-sm"
                           style="background-color:#031832;color:white; margin:2px;
                                  padding:4px 10px;
                                  font-size:0.8rem;
                                  min-width:65px;">
                            Editar
                        </a>

                        <form action="{{ route('proveedores.destroy', $proveedor->id_proveedor) }}"
                              method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm"
                                    style="padding:4px 10px; background-color:#8C0606;color:white; margin:2px;
                                           font-size:0.8rem;
                                           min-width:65px;"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este Proveedor?')">
                                Eliminar
                            </button>
                        </form>

                    </div>
                </td>
            </tr>

            {{-- FILA DETALLE (solo móvil) --}}
            <tr id="detalle-{{ $proveedor->id_proveedor }}" class="fila-detalle d-sm-none">
                <td colspan="4">
                    <div class="detalle-box">
                        <div class="detalle-item"><span>RUC/Cédula:</span> {{ $proveedor->prv_ruc_ced }}</div>
                        <div class="detalle-item"><span>Teléfono:</span> {{ $proveedor->prv_telefono }}</div>
                        <div class="detalle-item"><span>Email:</span> {{ $proveedor->prv_mail }}</div>
                        <div class="detalle-item"><span>Ciudad:</span> {{ $proveedor->ciudades->ciu_descripcion ?? '-' }}</div>
                        <div class="detalle-item"><span>Celular:</span> {{ $proveedor->prv_celular }}</div>
                        <div class="detalle-item"><span>Dirección:</span> {{ $proveedor->prv_direccion }}</div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $proveedores->appends(request()->query())->links() }}
</div>

@push('scripts')
<script>
    function toggleDetalle(id) {
        const row = document.getElementById('detalle-' + id);
        if (!row) return;

        document.querySelectorAll('.fila-detalle').forEach(r => {
            if (r !== row) r.style.display = 'none';
        });

        row.style.display = (row.style.display === 'table-row') ? 'none' : 'table-row';
    }
</script>
@endpush

@endsection
