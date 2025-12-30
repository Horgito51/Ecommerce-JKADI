@extends('layouts.contentAdmin')

@section('content')

<div class="container-fluid">

    <h4 class="mb-4">Editar Orden de Compra</h4>

    <form method="POST" action="{{ route('ordenes.update', $compra->id_compra) }}">
        @csrf
        @method('PUT')

        {{-- ================= DATOS COMPRA ================= --}}
        <div class="card mb-4">
            <div class="card-header">Datos de la compra</div>
            <div class="card-body">
                <div class="row">

                    {{-- Proveedor --}}
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Proveedor *</label>
                        <select name="id_proveedor"
                                class="form-control @error('id_proveedor') is-invalid @enderror"
                                required>
                            <option value="">Seleccione un proveedor</option>
                            @foreach ($proveedores as $prov)
                                <option value="{{ $prov->id_proveedor }}"
                                    {{ old('id_proveedor', $compra->id_proveedor) == $prov->id_proveedor ? 'selected' : '' }}>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                Productos
                <button type="button" class="btn btn-sm btn-primary" id="btnAgregar">
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

                        {{-- SI HAY ERROR DE VALIDACIÓN --}}
                        @if(old('productos'))
                            @foreach(old('productos') as $i => $prod)
                                <tr>
                                    <td>
                                        <select name="productos[{{ $i }}][id_producto]"
                                                class="form-control producto" required>
                                            <option value="">Seleccione</option>
                                            @foreach ($productos as $p)
                                                <option value="{{ $p->id_producto }}"
                                                        data-precio="{{ $p->pro_valor_compra }}"
                                                        {{ $prod['id_producto'] == $p->id_producto ? 'selected' : '' }}>
                                                    {{ $p->pro_descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="number"
                                               name="productos[{{ $i }}][pxo_cantidad]"
                                               class="form-control cantidad"
                                               value="{{ $prod['pxo_cantidad'] }}"
                                               min="1" required>
                                    </td>

                                    <td>
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
                                               value="{{ number_format($prod['pxo_cantidad'] * $prod['pxo_valor'], 3) }}"
                                               readonly>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger btnEliminar">X</button>
                                    </td>
                                </tr>
                            @endforeach

                        {{-- CASO NORMAL: CARGAR DESDE BD --}}
                        @else
                            @foreach($compra->productos as $i => $prod)
                                <tr>
                                    <td>
                                        <select name="productos[{{ $i }}][id_producto]"
                                                class="form-control producto" required>
                                            <option value="">Seleccione</option>
                                            @foreach ($productos as $p)
                                                <option value="{{ $p->id_producto }}"
                                                        data-precio="{{ $p->pro_valor_compra }}"
                                                        {{ $prod->id_producto == $p->id_producto ? 'selected' : '' }}>
                                                    {{ $p->pro_descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="number"
                                               name="productos[{{ $i }}][pxo_cantidad]"
                                               class="form-control cantidad"
                                               value="{{ $prod->pivot->pxo_cantidad }}"
                                               min="1" required>
                                    </td>

                                    <td>
                                        <input type="number"
                                               step="0.001"
                                               name="productos[{{ $i }}][pxo_valor]"
                                               class="form-control valor"
                                               value="{{ $prod->pivot->pxo_valor }}"
                                               readonly>
                                    </td>

                                    <td>
                                        <input type="text"
                                               class="form-control subtotal"
                                               value="{{ number_format($prod->pivot->pxo_subtotal, 3) }}"
                                               readonly>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger btnEliminar">X</button>
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

                <input type="hidden" name="oc_subtotal" id="oc_subtotal">
                <input type="hidden" name="oc_iva" id="oc_iva">
                <input type="hidden" name="oc_total" id="oc_total">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Actualizar compra</button>
            <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let index = {{ old('productos') ? count(old('productos')) : 0 }};
    const btnAgregar = document.getElementById('btnAgregar');
    const tbody = document.querySelector('#tabla-productos tbody');

    // =========================
    // AGREGAR FILA
    // =========================
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

            <td>
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
                        class="btn btn-sm btn-danger btnEliminar">
                    X
                </button>
            </td>
        </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', fila);
        index++;
    });

    // =========================
    // ELIMINAR FILA
    // =========================
    tbody.addEventListener('click', function (e) {
        if (e.target.classList.contains('btnEliminar')) {
            e.target.closest('tr').remove();
            recalcularTotales();
        }
    });

    // =========================
    // CUANDO CAMBIA EL PRODUCTO
    // =========================
    tbody.addEventListener('change', function (e) {

        if (e.target.classList.contains('producto')) {

            const seleccionado = e.target.value;

            // 🔒 VALIDAR PRODUCTO REPETIDO
            let repetido = false;

            document.querySelectorAll('.producto').forEach(select => {
                if (select !== e.target && select.value === seleccionado && seleccionado !== '') {
                    repetido = true;
                }
            });

            if (repetido) {
                alert('Este producto ya fue seleccionado.');
                e.target.value = '';
                return;
            }

            const fila = e.target.closest('tr');

            const precio = parseFloat(
                e.target.selectedOptions[0]?.dataset.precio || 0
            );

            const cantidad = parseFloat(
                fila.querySelector('.cantidad').value
            ) || 0;

            fila.querySelector('.valor').value = precio.toFixed(3);
            fila.querySelector('.subtotal').value =
                (cantidad * precio).toFixed(3);

            recalcularTotales();
        }
    });

    // =========================
    // CUANDO CAMBIA LA CANTIDAD
    // =========================
    tbody.addEventListener('input', function (e) {

        if (e.target.classList.contains('cantidad')) {

            const fila = e.target.closest('tr');

            const cantidad = parseFloat(e.target.value) || 0;
            const precio = parseFloat(
                fila.querySelector('.valor').value
            ) || 0;

            fila.querySelector('.subtotal').value =
                (cantidad * precio).toFixed(3);

            recalcularTotales();
        }
    });

    // =========================
    // SUBTOTAL GENERAL + IVA
    // =========================
    function recalcularTotales() {

        let subtotalGeneral = 0;

        document.querySelectorAll('.subtotal').forEach(el => {
            subtotalGeneral += parseFloat(el.value) || 0;
        });

        const iva = subtotalGeneral * 0.15;
        const total = subtotalGeneral + iva;

        // visibles
        document.getElementById('subtotal').value = subtotalGeneral.toFixed(2);
        document.getElementById('iva').value = iva.toFixed(2);
        document.getElementById('total').value = total.toFixed(2);

        // hidden (backend)
        document.getElementById('oc_subtotal').value = subtotalGeneral.toFixed(2);
        document.getElementById('oc_iva').value = iva.toFixed(2);
        document.getElementById('oc_total').value = total.toFixed(2);
    }

});
</script>

@endsection
