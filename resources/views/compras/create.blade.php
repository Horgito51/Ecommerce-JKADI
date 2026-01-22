@extends('layouts.contentAdmin')

@section('content')

<div class="container-fluid">

    <h4 class="mb-4">Nueva Orden de Compra</h4>

    <form method="POST" action="{{ route('ordenes.store') }}">
        @csrf

        {{-- ================= DATOS DE LA COMPRA ================= --}}
        <div class="card mb-4">
            <div class="card-header">
                Datos de la compra
            </div>

            <div class="card-body">
                <div class="row">
                    {{-- PROVEEDOR --}}
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Proveedor *</label>
                        <select name="id_proveedor"
                            class="form-control @error('id_proveedor') is-invalid @enderror"
                            required>
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($proveedores as $prov)
                                <option value="{{ $prov->id_proveedor }}"
                                    {{ old('id_proveedor') == $prov->id_proveedor ? 'selected' : '' }}>
                                    {{ $prov->prv_nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_proveedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PRODUCTOS ================= --}}
        <div class="card mb-4">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between gap-2">
                <span>Productos</span>
                <button type="button" class="btn btn-primary btn-sm" id="btnAgregar">
                    + Agregar producto
                </button>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle" id="tabla-productos">
                    <thead class="table-light">
                        <tr>
                            <th>Producto *</th>
                            <th style="width:120px">Cantidad *</th>
                            <th style="width:120px" class="d-none d-md-table-cell">Valor *</th>
                            <th style="width:120px">Subtotal</th>
                            <th style="width:60px"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(old('productos'))
                            @foreach(old('productos') as $i => $prod)
                                <tr>
                                    <td>
                                        <select name="productos[{{ $i }}][id_producto]"
                                            class="form-control producto @error("productos.$i.id_producto") is-invalid @enderror"
                                            required>
                                            <option value="">Seleccione</option>
                                            @foreach ($productos as $p)
                                                <option value="{{ $p->id_producto }}"
                                                    data-precio="{{ $p->pro_valor_compra }}"
                                                    {{ $prod['id_producto'] == $p->id_producto ? 'selected' : '' }}>
                                                    {{ $p->pro_descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("productos.$i.id_producto")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="number"
                                            name="productos[{{ $i }}][pxo_cantidad]"
                                            class="form-control cantidad @error("productos.$i.pxo_cantidad") is-invalid @enderror"
                                            value="{{ $prod['pxo_cantidad'] }}"
                                            min="1"
                                            required>
                                    </td>

                                    <td class="d-none d-md-table-cell">
                                        <input type="number"
                                            step="0.001"
                                            name="productos[{{ $i }}][pxo_valor]"
                                            class="form-control valor"
                                            value="{{ $prod['pxo_valor'] }}"
                                            readonly>
                                    </td>

                                    <td>
                                        <input type="text"
                                            class="form-control subtotal"
                                            readonly>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btnEliminar px-3">
                                            ✕
                                        </button>
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

        {{-- ================= TOTALES ================= --}}
        <div class="row justify-content-end">
            <div class="col-12 col-sm-8 col-md-4">
                <div class="mb-2">
                    <label>Subtotal</label>
                    <input type="text" id="subtotal" class="form-control" readonly>
                </div>
                <div class="mb-2">
                    <label>IVA </label>
                    <input type="text" id="iva" class="form-control" readonly>
                </div>
                <div class="mb-2">
                    <label>Total</label>
                    <input type="text" id="total" class="form-control" readonly>
                </div>

                <input type="hidden" name="oc_subtotal" id="oc_subtotal">
                <input type="hidden" name="oc_iva" id="oc_iva">
                <input type="hidden" name="oc_total" id="oc_total">
            </div>
        </div>

        {{-- ================= BOTONES ================= --}}
        <div class="mt-4 d-flex flex-column flex-md-row gap-2">
            <button type="submit" class="btn btn-success" id="btnGuardar">
                Guardar compra
            </button>
            <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>

    </form>
</div>

{{-- ================= JS ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    let index = {{ old('productos') ? count(old('productos')) : 0 }};
    const btnAgregar = document.getElementById('btnAgregar');
    const tbody = document.querySelector('#tabla-productos tbody');

    btnAgregar.addEventListener('click', function () {

        const fila = `
        <tr>
            <td>
                <select name="productos[${index}][id_producto]"
                        class="form-control producto"
                        required>
                    <option value="">Seleccione</option>
                    @foreach ($productos as $p)
                        <option value="{{ $p->id_producto }}"
                                data-precio="{{ $p->pro_valor_compra }}">
                            {{ $p->pro_descripcion }}
                        </option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="number"
                       name="productos[${index}][pxo_cantidad]"
                       class="form-control cantidad"
                       value="1"
                       min="1"
                       required>
            </td>

            <td class="d-none d-md-table-cell">
                <input type="number"
                       step="0.001"
                       name="productos[${index}][pxo_valor]"
                       class="form-control valor"
                       readonly>
            </td>

            <td>
                <input type="text"
                       class="form-control subtotal"
                       value="0.000"
                       readonly>
            </td>

            <td class="text-center">
                <button type="button"
                        class="btn btn-danger btnEliminar px-3">
                    ✕
                </button>
            </td>
        </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', fila);
        index++;
    });

    tbody.addEventListener('click', function (e) {
        if (e.target.classList.contains('btnEliminar')) {
            e.target.closest('tr').remove();
            recalcularTotales();
        }
    });

    tbody.addEventListener('change', function (e) {
        if (e.target.classList.contains('producto')) {

            let repetido = false;
            document.querySelectorAll('.producto').forEach(select => {
                if (select !== e.target && select.value === e.target.value && e.target.value !== '') {
                    repetido = true;
                }
            });

            if (repetido) {
                alert('Este producto ya fue seleccionado.');
                e.target.value = '';
                return;
            }

            const fila = e.target.closest('tr');
            const precio = parseFloat(e.target.selectedOptions[0]?.dataset.precio || 0);
            const cantidad = parseFloat(fila.querySelector('.cantidad').value || 0);

            fila.querySelector('.valor').value = precio.toFixed(3);
            fila.querySelector('.subtotal').value = (precio * cantidad).toFixed(3);

            recalcularTotales();
        }
    });

    tbody.addEventListener('input', function (e) {
        if (e.target.classList.contains('cantidad')) {
            const fila = e.target.closest('tr');
            const cantidad = parseFloat(e.target.value || 0);
            const preciomier = parseFloat(fila.querySelector('.valor').value || 0);

            fila.querySelector('.subtotal').value = (cantidad * precio).toFixed(3);
            recalcularTotales();
        }
    });

    function recalcularTotales() {
        let subtotal = 0;
        document.querySelectorAll('.subtotal').forEach(el => {
            subtotal += parseFloat(el.value || 0);
        });

        const iva = subtotal * 0.15;
        const total = subtotal + iva;

        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('iva').value = iva.toFixed(2);
        document.getElementById('total').value = total.toFixed(2);

        document.getElementById('oc_subtotal').value = subtotal.toFixed(2);
        document.getElementById('oc_iva').value = iva.toFixed(2);
        document.getElementById('oc_total').value = total.toFixed(2);
    }

    document.querySelector('form').addEventDListener('submit', function(event) {
    const botonGuardar = document.getElementById('btnGuardar');
    botonGuardar.disabled = true;  // Desactiva el botón
});

});
</script>

@endsection
