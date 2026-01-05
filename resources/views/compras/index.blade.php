@php
    $searchRoute = route('ordenes.index');
    $searchPlaceholder = 'Buscar por Código, proveedor o valor total';
    $searchExtraParams = [
        'estado' => request('estado', []),
    ];
@endphp

@extends('layouts.contentAdmin')

@section('content')

@push('styles')
<style>
    /* SOLO ocultar columnas en celular, no tocar botones */
    @media (max-width: 576px) {
        th.col-detalle, td.col-detalle {
            display: none !important;
        }
    }

    /* Fila detalle móvil */
    .fila-detalle {
        display: none;
        background: #f8f9fa;
    }
    .fila-detalle .detalle-box{
        padding: 10px 12px;
        border: 1px solid #031832;
        border-radius: 8px;
        text-align: left;
        color: #031832;
    }
    .detalle-item span{
        font-weight: 600;
    }
</style>
@endpush

<h2 class="mb-3" style="color:#031832">
    Lista de Órdenes de Compra
</h2>

{{-- BOTÓN CREAR --}}
<div class="d-flex flex-column flex-sm-row gap-2 mb-3">
    <a href="{{ route('ordenes.create') }}"
       class="btn d-block d-sm-inline-block"
       style="background-color:#198754;color:white">
        Crear
    </a>
</div>

<form method="GET"
      action="{{ route('ordenes.index') }}"
      class="mb-3"
      onchange="this.submit()">

    {{-- mantener búsqueda --}}
    <input type="hidden" name="search" value="{{ request('search') }}">

    <div class="d-flex flex-wrap gap-4 align-items-center">

        <label class="form-check" style="margin:5px">
            <input class="form-check-input"
                   type="checkbox"
                   name="estado[]"
                   value="ACT"
                   {{ in_array('ACT', request('estado', [])) ? 'checked' : '' }}>
            <span class="form-check-label">Activo</span>
        </label>

        <label class="form-check" style="margin:8px">
            <input class="form-check-input"
                   type="checkbox"
                   name="estado[]"
                   value="APR"
                   {{ in_array('APR', request('estado', [])) ? 'checked' : '' }}>
            <span class="form-check-label">Aprobado</span>
        </label>

        <label class="form-check" style="margin:8px">
            <input class="form-check-input"
                   type="checkbox"
                   name="estado[]"
                   value="ANU"
                   {{ in_array('ANU', request('estado', [])) ? 'checked' : '' }}>
            <span class="form-check-label">Anulado</span>
        </label>

    </div>
</form>

{{-- TABLA RESPONSIVE --}}
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead style="background-color:#031832;color:white">
            <tr class="text-center">
                <th>ID</th>
                <th>Proveedor</th>
                <th class="col-detalle">Fecha</th>
                <th class="col-detalle">Subtotal</th>
                <th class="col-detalle">IVA</th>
                <th class="col-detalle">Total</th>
                <th class="col-detalle">Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody style="color:#031832;border-color:#031832">
            @foreach ($compras as $orden)
                <tr class="text-center {{ $loop->odd ? 'fila-zebra' : '' }}">

                    <td>{{ $orden->id_compra }}</td>

                    <td class="text-start">
                        {{ $orden->proveedor->prv_nombre }}
                    </td>

                    {{-- Fecha --}}
                    <td class="col-detalle">
                        {{ \Carbon\Carbon::parse($orden->created_at)->format('d/m/Y') }}
                    </td>

                    <td class="col-detalle">${{ number_format($orden->oc_subtotal, 2) }}</td>
                    <td class="col-detalle">${{ number_format($orden->oc_iva, 2) }}</td>
                    <td class="col-detalle">${{ number_format($orden->oc_total, 2) }}</td>

                    <td class="col-detalle">
                        {{
                            $orden->estado_oc === 'ACT' ? 'Activo' :
                            ($orden->estado_oc === 'ANU' ? 'Anulado' :
                            ($orden->estado_oc === 'APR' ? 'Aprobado' : $orden->estado_oc))
                        }}
                    </td>

                    {{-- ACCIONES --}}
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-1 justify-content-center acciones-botones">

                            {{-- Hamburguesa SOLO en celular (NO toca estilos de tus botones) --}}
                            <button type="button"
                                    class="btn btn-sm d-sm-none btn-hamburguesa"
                                    onclick="toggleDetalle('{{ $orden->id_compra }}')">
                                ☰
                            </button>

                            {{-- Editar/Detalle (MISMO estilo original) --}}
                            <a href="{{ route('ordenes.edit', $orden->id_compra) }}"
                               class="btn btn-sm"
                               style="background-color:#031832;
                                      color:white;
                                      padding:4px 10px;
                                      font-size:0.8rem;
                                      min-width:65px;">
                                {{ $orden->estado_oc === 'ACT' ? 'Editar' : 'Detalle' }}
                            </a>

                            {{-- Eliminar (MISMO estilo original) --}}
                            @if ($orden->estado_oc === 'ACT')
                                <form action="{{ route('ordenes.destroy', $orden->id_compra) }}"
                                      method="POST"
                                      class="m-0">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm"
                                            style="background-color:#8C0606;
                                                   color:white;
                                                   padding:4px 10px;
                                                   font-size:0.8rem;
                                                   min-width:65px;"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta orden?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>

                </tr>

                {{-- FILA DETALLE (solo móvil) --}}
                <tr id="detalle-{{ $orden->id_compra }}" class="fila-detalle d-sm-none">
                    <td colspan="4">
                        <div class="detalle-box">
                            <div class="detalle-item"><span>Fecha:</span> {{ \Carbon\Carbon::parse($orden->created_at)->format('d/m/Y') }}</div>
                            <div class="detalle-item"><span>Subtotal:</span> ${{ number_format($orden->oc_subtotal, 2) }}</div>
                            <div class="detalle-item"><span>IVA:</span> ${{ number_format($orden->oc_iva, 2) }}</div>
                            <div class="detalle-item"><span>Total:</span> ${{ number_format($orden->oc_total, 2) }}</div>
                            <div class="detalle-item">
                                <span>Estado:</span>
                                {{
                                    $orden->estado_oc === 'ACT' ? 'Activo' :
                                    ($orden->estado_oc === 'ANU' ? 'Anulado' :
                                    ($orden->estado_oc === 'APR' ? 'Aprobado' : $orden->estado_oc))
                                }}
                            </div>
                        </div>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $compras->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

@push('scripts')
<script>
    function toggleDetalle(id) {
        const row = document.getElementById('detalle-' + id);
        if (!row) return;

        // cerrar otros (opcional)
        document.querySelectorAll('.fila-detalle').forEach(r => {
            if (r !== row) r.style.display = 'none';
        });

        row.style.display = (row.style.display === 'table-row') ? 'none' : 'table-row';
    }
</script>
@endpush

@endsection
