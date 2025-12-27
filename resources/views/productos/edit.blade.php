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
                   value="{{ old('pro_descripcion', $productos->pro_descripcion) }}"
                   class="form-control @error('pro_descripcion') is-invalid @enderror"
                   required>
            @error('pro_descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- TIPO --}}
        <div class="form-group mt-3">
            <label for="tipo_Producto">Tipo:</label>
            <select name="tipo_Producto"
                    id="tipo_Producto"
                    class="form-control @error('tipo_Producto') is-invalid @enderror"
                    required>
                <option value="">Seleccione Tipo</option>
                @foreach ($tiposProducto as $tipo)
                    <option value="{{ $tipo->id_tipo }}"
                        {{ old('tipo_Producto', $productos->id_tipo) == $tipo->id_tipo ? 'selected' : '' }}>
                        {{ $tipo->tipo_descripcion }}
                    </option>
                @endforeach
            </select>
            @error('tipo_Producto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- UM COMPRA --}}
        <div class="form-group mt-3">
            <label for="unidad_medida_compra">Unidad de Medida (Compra):</label>
            <select name="unidad_medida_compra"
                    id="unidad_medida_compra"
                    class="form-control @error('unidad_medida_compra') is-invalid @enderror"
                    required>
                <option value="">Seleccione Unidad de Medida</option>
                @foreach ($unidadesMedidas as $UM)
                    <option value="{{ $UM->id_unidad_medida }}"
                        {{ old('unidad_medida_compra', $productos->pro_um_compra) == $UM->id_unidad_medida ? 'selected' : '' }}>
                        {{ $UM->um_descripcion }}
                    </option>
                @endforeach
            </select>
            @error('unidad_medida_compra')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- UM VENTA --}}
        <div class="form-group mt-3">
            <label for="unidad_medida_venta">Unidad de Medida (Venta):</label>
            <select name="unidad_medida_venta"
                    id="unidad_medida_venta"
                    class="form-control @error('unidad_medida_venta') is-invalid @enderror"
                    required>
                <option value="">Seleccione Unidad de Medida</option>
                @foreach ($unidadesMedidas as $UM)
                    <option value="{{ $UM->id_unidad_medida }}"
                        {{ old('unidad_medida_venta', $productos->pro_um_venta) == $UM->id_unidad_medida ? 'selected' : '' }}>
                        {{ $UM->um_descripcion }}
                    </option>
                @endforeach
            </select>
            @error('unidad_medida_venta')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- SALDO --}}
        <div class="form-group mt-3">
            <label for="saldo_inicial">Saldo Inicial:</label>
            <input type="number"
                   id="saldo_inicial"
                   name="saldo_inicial"
                   value="{{ old('saldo_inicial', $productos->pro_saldo_inicial) }}"
                   class="form-control @error('saldo_inicial') is-invalid @enderror"
                   required>
            @error('saldo_inicial')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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