@extends('layouts.contentAdmin')

@section('content')

<h2 class="mb-3" style="color:#031832">Lista de Proveedores</h2>

<div class="d-flex flex-column flex-sm-row gap-2 mb-3">
    <a href="{{ route('proveedores.create') }}"
       class="btn d-block d-sm-inline-block"
       style="background-color:#198754;color:white">
        Crear
    </a>
</div>

<div class="table-responsive border rounded shadow-sm">
    <table class="table table-bordered table-hover align-middle text-nowrap mb-0">

        <thead style="background-color:#031832;color:white">
        <tr class="text-center">
            <th>ID</th>
            <th>Nombre</th>
            <th>RUC/Cédula</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Ciudad</th>
            <th>Celular</th>
            <th>Dirección</th>
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

                <td class="col-detalle" title="{{ $proveedor->prv_ruc_ced }}">
                    {{ $proveedor->prv_ruc_ced }}
                </td>

                <td class="col-detalle" title="{{ $proveedor->prv_telefono }}">
                    {{ $proveedor->prv_telefono ?? 'N/A' }}
                </td>

                <td class="col-detalle" title="{{ $proveedor->prv_mail }}">
                    {{ $proveedor->prv_mail }}
                </td>

                <td>
                    {{ $proveedor->ciudades->ciu_descripcion ?? '-' }}
                </td>

                <td class="col-detalle" title="{{ $proveedor->prv_celular }}">
                    {{ $proveedor->prv_celular }}
                </td>

                <td class="col-detalle" title="{{ $proveedor->prv_direccion }}">
                    {{ $proveedor->prv_direccion }}
                </td>

                <td class="td-acciones">
                    <div class="d-flex flex-column flex-md-row gap-1 justify-content-center acciones-botones">

                        <a href="{{ route('proveedores.edit', $proveedor->id_proveedor) }}"
                           class="btn btn-sm"
                           style="background-color:#031832;color:white;
                                  padding:4px 10px;
                                  font-size:0.8rem;
                                  min-width:65px;">
                            Editar
                        </a>

                        <form action="{{ route('proveedores.destroy', $proveedor->id_proveedor) }}"
                              method="POST"
                              class="m-0 form-eliminar-proveedor">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm"
                                    style="padding:4px 10px;
                                           background-color:#8C0606;
                                           color:white;
                                           font-size:0.8rem;
                                           min-width:65px;">
                                Eliminar
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>

{{-- Paginación --}}
<div class="pagination-wrapper d-flex justify-content-center mt-4">
    {{ $proveedores->links('pagination::bootstrap-5', ['class' => 'pagination pagination-sm']) }}
</div>

<p class="text-muted small text-center mt-2">
    Página {{ $proveedores->currentPage() }} de {{ $proveedores->lastPage() }} ·
    {{ $proveedores->total() }} proveedores
</p>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.form-eliminar-proveedor').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Eliminar proveedor?',
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
