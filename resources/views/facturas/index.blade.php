@extends('layouts.contentAdmin')

@section('content')
<h2 style="color:#031832">Lista de Facturas</h2>

<div class="mb-3 gap-2">
    <a href="{{route('facturas.create')}}"
       class="btn"
       style="background-color:#198754;color:white">
        Crear
    </a>
</div>

<div>
    <table class="table table-striped table-bordered">
        <thead style="background-color:#031832;color:white">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Descripcion</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody style="background-color:white;color:#031832;border-color:#031832">


            @foreach ($facturas as $factura)
                <tr>
                    <td>{{ $factura->id_factura }}</td>
                    <td>{{ $factura->clientes->cli_nombre }}</td>
                    <td>{{ $factura->fac_descripcion }}</td>
                    <td>${{ number_format($factura->fac_subtotal, 2) }}</td>
                    <td>${{ number_format($factura->fac_iva, 2) }}</td>
                    <td>${{ number_format($factura->fac_total, 2) }}</td>

                    <td>{{ $factura->fac_estado }}</td>
                    <td>

                        <div class="d-flex gap-1 justify-content-center">

                            <a href="{{route('facturas.edit',$factura->id_factura)}}"
                               class="btn btn-sm"
                               style="background-color:#031832;color:white;
                                      margin:2px;
                                      padding:4px 10px;
                                      font-size:0.8rem;
                                      min-width:65px;">
                                {{$factura->fac_estado ==='APR' ? 'Detalle':'Editar'}}
                            </a>
                            @if ($factura->fac_estado=== 'ABI')
                                <form action="{{ route('facturas.destroy', $factura) }}"
                                    method="POST"
                                    class="m-0 form-eliminar-facturas">
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.form-eliminar-facturas').forEach(form => {

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
