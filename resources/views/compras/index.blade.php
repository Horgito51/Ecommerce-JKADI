@extends('layouts.contentAdmin')

@section('content')
<h2 style="color:#031832">Lista de Órdenes de Compra</h2>

<div class="mb-3 gap-2">
    <a href="{{ route('ordenes.create') }}"
       class="btn"
       style="background-color:#198754;color:white">
        Crear orden de compra
    </a>
</div>

<div>
    <table class="table table-striped table-bordered">
        <thead style="background-color:#031832;color:white">
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody style="background-color:white;color:#031832;border-color:#031832">
            @foreach ($compras as $orden)
                <tr>
                    <td>{{ $orden->id_compra }}</td>
                    <td>{{ $orden->proveedor->prv_nombre }}</td>

                    {{-- Fecha desde created_at --}}
                    <td>
                        {{ \Carbon\Carbon::parse($orden->created_at)->format('d/m/Y') }}
                    </td>

                    <td>${{ number_format($orden->oc_subtotal, 2) }}</td>
                    <td>${{ number_format($orden->oc_iva, 2) }}</td>
                    <td>${{ number_format($orden->oc_total, 2) }}</td>
                    <td>
                        {{
                            $orden->estado_oc === 'ACT' ? 'Activo' :
                            ($orden->estado_oc === 'ANU' ? 'Anulado' :
                            ($orden->estado_oc === 'APR' ? 'Aprobado' : $orden->estado_oc))
                        }}
                    </td>
                    <td>
                        <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('ordenes.edit', $orden->id_compra) }}"
                                class="btn btn-sm"
                                style="background-color:#031832;color:white;
                                        margin:2px;
                                        padding:4px 10px;
                                        font-size:0.8rem;
                                        min-width:65px;">
                                     {{ $orden->estado_oc === 'ACT' ? 'Editar' : 'Detalle' }}
                                </a>
                            {{-- BOTÓN ELIMINAR --}}
                            @if ($orden->estado_oc === 'ACT')
                                <form action="{{ route('ordenes.destroy', $orden->id_compra) }}"
                                    method="POST"
                                    class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm"
                                            style="padding:4px 10px;
                                                background-color:#8C0606;
                                                color:white;
                                                margin:2px;
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
