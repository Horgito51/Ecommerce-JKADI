@extends('layouts.contentAdmin')

@section('content')

    <div class="container-fluid">

        <h4 class="mb-4">Editar Factura</h4>

        @php
            $bloqueado = $factura->fac_estado !== 'ABI';
        @endphp

        <form method="POST" action="{{ route('facturas.update', $factura->id_factura) }}">
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-header">Datos de la factura: {{ $factura->id_factura }}</div>
                <div class="card-body">
                    <div class="row">
                        {{-- Cliente --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Cliente *</label>
                            <select name="id_cliente" class="form-control @error('id_cliente') is-invalid @enderror"
                                required {{ $bloqueado ? 'disabled' : '' }}>
                                <option value="">Seleccione un cliente</option>
                                @foreach ($clientes as $cli)
                                    <option value="{{ $cli->id_cliente }}"
                                        {{ old('id_cliente', $factura->id_cliente) == $cli->id_cliente ? 'selected' : '' }}>
                                        {{ $cli->cli_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_cliente')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="card mb-4">
                <div class="card-header">Descripción de la factura</div>
                <div class="card-body">
                    <textarea name="fac_descripcion" class="form-control  @error('fac_descripcion') is-invalid @enderror" rows="4"
                        required {{ $bloqueado ? 'disabled' : '' }}>{{ old('fac_descripcion', $factura->fac_descripcion) }}</textarea>
                    @error('fac_descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- PRODUCTOS --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Productos
                    <button type="button" class="btn btn-sm btn-primary" id="btnAgregar" {{ $bloqueado ? 'hidden' : '' }}>
                        + Agregar producto
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered align-middle" id="tabla-productos">
                        <thead class="table-light">
                            <tr>
                                <th>Producto *</th>
                                <th width="120">Cantidad *</th>
                                <th width="120">Valor *</th>
                                <th width="120">Subtotal</th>
                                <th width="80"></th>
                            </tr>
                        </thead>

                        <tbody>

                            @if (old('productos'))
                                @foreach (old('productos') as $i => $prod)
                                    <tr>
                                        <td>
                                            <select name="productos[{{ $i }}][id_producto]"
                                                class="form-control producto" required {{ $bloqueado ? 'disabled' : '' }}>
                                                <option value="">Seleccione</option>
                                                @foreach ($productos as $p)
                                                    <option value="{{ $p->id_producto }}"
                                                        data-precio="{{ $p->pro_precio_venta }}"
                                                        {{ $prod['id_producto'] == $p->id_producto ? 'selected' : '' }}>
                                                        {{ $p->pro_descripcion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="number" name="productos[{{ $i }}][pxf_cantidad]"
                                                class="form-control cantidad" value="{{ $prod['pxf_cantidad'] }}"
                                                min="1" required {{ $bloqueado ? 'disabled' : '' }}>
                                        </td>

                                        <td>
                                            <input type="number" step="0.001"
                                                name="productos[{{ $i }}][pxf_precio]"
                                                class="form-control valor" value="{{ $prod['pxf_precio'] }}" readonly>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control subtotal"
                                                value="{{ number_format($prod['pxf_cantidad'] * $prod['pxf_precio'], 3) }}"
                                                readonly>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger btnEliminar"
                                            {{ $bloqueado ? 'hidden' : '' }}>X</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($factura->productos as $i => $prod)
                                    <tr>
                                        <td>
                                            <select name="productos[{{ $i }}][id_producto]"
                                                class="form-control producto" required {{ $bloqueado ? 'disabled' : '' }}>
                                                <option value="">Seleccione</option>
                                                @foreach ($productos as $p)
                                                    <option value="{{ $p->id_producto }}"
                                                        data-precio="{{ $p->pro_precio_venta }}"
                                                        {{ $prod->id_producto == $p->id_producto ? 'selected' : '' }}>
                                                        {{ $p->pro_descripcion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="number" name="productos[{{ $i }}][pxf_cantidad]"
                                                class="form-control cantidad" value="{{ $prod->pivot->pxf_cantidad }}"
                                                min="1" required {{ $bloqueado ? 'disabled' : '' }}>
                                        </td>

                                        <td>
                                            <input type="number" step="0.001"
                                                name="productos[{{ $i }}][pxf_precio]"
                                                class="form-control valor" value="{{ $prod->pivot->pxf_precio }}" readonly>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control subtotal"
                                                value="{{ number_format($prod->pivot->pxf_subtotal, 3) }}" readonly>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger btnEliminar"
                                             {{ $bloqueado ? 'hidden' : '' }}>X</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                    @error('productos')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- TOTALES --}}
            <div class="row justify-content-end">
                <div class="col-12 col-md-4">
                    <div class="mb-2">
                        <label>Subtotal</label>
                        <input type="text" id="subtotal" class="form-control" readonly>
                    </div>
                    <div class="mb-2">
                        <label>IVA (15%)</label>
                        <input type="text" id="iva" class="form-control" readonly>
                    </div>
                    <div class="mb-2">
                        <label>Total</label>
                        <input type="text" id="total" class="form-control" readonly>
                    </div>

                    <input type="hidden" name="fac_subtotal" id="fac_subtotal">
                    <input type="hidden" name="fac_iva" id="fac_iva">
                    <input type="hidden" name="fac_total" id="fac_total">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success" {{ $bloqueado ? 'hidden' : '' }}>Actualizar</button>
                <a href="{{ route('facturas.aprobar', $factura->id_factura) }}"
                    style="background-color:#031832;color:white"
                    class="btn btn-secondary btn-aprobar-factura"
                     {{ $bloqueado ? 'hidden' : '' }}>Aprobar</a>

                <a href="{{ route('facturas.index') }}" class="btn btn-secondary"
                 style="{{ $bloqueado ?  'background-color:#031832' : 'background-color:#8C0606;' }}"
                 >
                 {{$bloqueado ? 'Regresar':'Cancelar'}}</a>

            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let index = {{ old('productos') ? count(old('productos')) : $factura->productos->count() }};
            const btnAgregar = document.getElementById('btnAgregar');
            const tbody = document.querySelector('#tabla-productos tbody');

            btnAgregar.addEventListener('click', function() {
                const fila = `
        <tr>
            <td>
                <select name="productos[${index}][id_producto]" class="form-control producto" required>
                    <option value="">Seleccione</option>
                    @foreach ($productos as $p)
                        <option value="{{ $p->id_producto }}" data-precio="{{ $p->pro_precio_venta }}">
                            {{ $p->pro_descripcion }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="productos[${index}][pxf_cantidad]" class="form-control cantidad" value="1" min="1" required>
            </td>
            <td>
                <input type="number" step="0.001" name="productos[${index}][pxf_precio]" class="form-control valor" readonly>
            </td>
            <td>
                <input type="text" class="form-control subtotal" value="0.000" readonly>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger btnEliminar">X</button>
            </td>
        </tr>`;
                tbody.insertAdjacentHTML('beforeend', fila);
                index++;
            });

            tbody.addEventListener('click', e => {
                if (e.target.classList.contains('btnEliminar')) {
                    e.target.closest('tr').remove();
                    recalcularTotales();
                }
            });

            tbody.addEventListener('change', e => {
                if (e.target.classList.contains('producto')) {
                    const fila = e.target.closest('tr');
                    const precio = parseFloat(e.target.selectedOptions[0]?.dataset.precio || 0);
                    const cantidad = parseFloat(fila.querySelector('.cantidad').value) || 0;

                    fila.querySelector('.valor').value = precio.toFixed(3);
                    fila.querySelector('.subtotal').value = (cantidad * precio).toFixed(3);
                    recalcularTotales();
                }
            });

            tbody.addEventListener('input', e => {
                if (e.target.classList.contains('cantidad')) {
                    const fila = e.target.closest('tr');
                    const cantidad = parseFloat(e.target.value) || 0;
                    const precio = parseFloat(fila.querySelector('.valor').value) || 0;

                    fila.querySelector('.subtotal').value = (cantidad * precio).toFixed(3);
                    recalcularTotales();
                }
            });

            function recalcularTotales() {
                let subtotal = 0;
                document.querySelectorAll('.subtotal').forEach(el => subtotal += parseFloat(el.value) || 0);

                const iva = subtotal * 0.15;
                const total = subtotal + iva;

                document.getElementById('subtotal').value = subtotal.toFixed(2);
                document.getElementById('iva').value = iva.toFixed(2);
                document.getElementById('total').value = total.toFixed(2);

                document.getElementById('fac_subtotal').value = subtotal.toFixed(2);
                document.getElementById('fac_iva').value = iva.toFixed(2);
                document.getElementById('fac_total').value = total.toFixed(2);
            }

            recalcularTotales();
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-aprobar-factura').forEach(btn => {

        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const url = btn.getAttribute('href');

            Swal.fire({
                title: '¿Aprobar factura?',
                text: 'Esta acción no se puede deshacer',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#031832',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, aprobar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

    });

});
</script>

@endsection
