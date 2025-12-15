@extends('layouts.contentAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Producto</h2>

    <form action="{{ route('productos.update', $productos->id_producto) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ID PRODUCTO --}}
        <div class="form-group">
            <label for="id_producto">ID Producto:</label>
            <input type="text"
                   id="id_producto"
                   name="id_producto"
                   value="{{ $productos->id_producto }}"
                   class="form-control"
                   readonly>
        </div>

        {{-- DESCRIPCIÓN --}}
        <div class="form-group mt-3">
            <label for="pro_descripcion">Descripción Producto:</label>
            <input type="text"
                   id="pro_descripcion"
                   name="pro_descripcion"
                   value="{{ $productos->pro_descripcion }}"
                   class="form-control"
                   required>
        </div>

        {{-- TIPO --}}
        <div class="form-group mt-3">
            <label for="tipo_Producto">Tipo:</label>
            <select name="tipo_Producto"
                    id="tipo_Producto"
                    class="form-control"
                    required>
                <option value="">Seleccione Tipo</option>
                @foreach ($tiposProducto as $tipo)
                    <option value="{{ $tipo->id_tipo }}"
                        {{ $productos->id_tipo == $tipo->id_tipo ? 'selected' : '' }}>
                        {{ $tipo->tipo_descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- UM COMPRA --}}
        <div class="form-group mt-3">
            <label for="unidad_medida_compra">Unidad de Medida (Compra):</label>
            <select name="unidad_medida_compra"
                    id="unidad_medida_compra"
                    class="form-control"
                    required>
                <option value="">Seleccione Unidad de Medida</option>
                @foreach ($unidadesMedidas as $UM)
                    <option value="{{ $UM->id_unidad_medida }}"
                        {{ $productos->pro_um_compra == $UM->id_unidad_medida ? 'selected' : '' }}>
                        {{ $UM->um_descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- UM VENTA --}}
        <div class="form-group mt-3">
            <label for="unidad_medida_venta">Unidad de Medida (Venta):</label>
            <select name="unidad_medida_venta"
                    id="unidad_medida_venta"
                    class="form-control"
                    required>
                <option value="">Seleccione Unidad de Medida</option>
                @foreach ($unidadesMedidas as $UM)
                    <option value="{{ $UM->id_unidad_medida }}"
                        {{ $productos->pro_um_venta == $UM->id_unidad_medida ? 'selected' : '' }}>
                        {{ $UM->um_descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- SALDO --}}
        <div class="form-group mt-3">
            <label for="saldo_inicial">Saldo Inicial:</label>
            <input type="number"
                   id="saldo_inicial"
                   name="saldo_inicial"
                   value="{{ $productos->pro_saldo_inicial }}"
                   class="form-control"
                   required>
        </div>

        {{-- BOTONES --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                Actualizar
            </button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
