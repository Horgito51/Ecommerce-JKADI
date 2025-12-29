@extends('layouts.contentAdmin')

@section('content')

<div class="container-fluid">

    <h4 class="mb-4">Nueva Orden de Compra</h4>

    <form method="POST" action="{{ route('ordenes.store') }}">
        @csrf
        <div class="card mb-4">
            <div class="card-header">
                Datos de la compra
            </div>
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

                        @if(old('productos'))
                            @foreach(old('productos') as $i => $prod)
                                <tr>
                                    <td>
                                        <select name="productos[{{ $i }}][id_producto]"
                                            class="form-control @error("productos.$i.id_producto") is-invalid @enderror"
                                            required>
                                            <option value="">Seleccione</option>
                                            @foreach ($productos as $p)
                                                <option value="{{ $p->id_producto }}"
                                                    {{ $prod['id_producto'] == $p->id_producto ? 'selected' : '' }}>
                                                    {{ $p->descripcion }}
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
                                            class="form-control @error("productos.$i.pxo_cantidad") is-invalid @enderror"
                                            value="{{ $prod['pxo_cantidad'] }}"
                                            min="1"
                                            required>
                                        @error("productos.$i.pxo_cantidad")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="number"
                                            step="0.001"
                                            name="productos[{{ $i }}][pxo_valor]"
                                            class="form-control @error("productos.$i.pxo_valor") is-invalid @enderror"
                                            value="{{ $prod['pxo_valor'] }}"
                                            required>
                                        @error("productos.$i.pxo_valor")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="text"
                                               class="form-control"
                                               readonly>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger btnEliminar">
                                            X
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
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                Guardar compra
            </button>
            <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>

    </form>

</div>

@endsection
