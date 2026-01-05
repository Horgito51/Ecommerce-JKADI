@php
    $searchRoute = route('ordenes.index');
    $searchPlaceholder = 'Buscar por Código, proveedor o valor total';
    $searchExtraParams = [
        'estado' => request('estado', []),
    ];
@endphp

@extends('layouts.contentAdmin')

@section('content')



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


                            <a href="{{ route('ordenes.edit', $orden->id_compra) }}"
                               class="btn btn-sm"
                               style="background-color:#031832;
                                      color:white;
                                      padding:4px 10px;
                                      font-size:0.8rem;
                                      min-width:65px;">
                                {{ $orden->estado_oc === 'ACT' ? 'Editar' : 'Detalle' }}
                            </a>

                            @if ($orden->estado_oc === 'ACT')
                                <form action="{{ route('ordenes.destroy', $orden->id_compra) }}"
                                      method="POST"
                                      class="m-0 form-eliminar-compra">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm"
                                            style="background-color:#8C0606;
                                                   color:white;
                                                   padding:4px 10px;
                                                   font-size:0.8rem;
                                                   min-width:65px;"
                                            >
                                        Eliminar
                                    </button>
                                </form>
                            @endif

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


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.form-eliminar-compra').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Eliminar Compra?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8C0606',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });

    });
});
</script>



@endsection
