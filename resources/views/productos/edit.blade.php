@extends('layouts.contentAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Producto</h2>

    <form action="{{ route('productos.update', $productos->id_producto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">

            {{-- ID PRODUCTO --}}
            <div class="col-12 col-md-6">
                <label>ID Producto:</label>
                <input type="text"
                       name="id_producto"
                       value="{{ $productos->id_producto }}"
                       class="form-control"
                       readonly>
            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="col-12 col-md-6">
                <label>Descripción Producto:</label>
                <input type="text"
                       name="pro_descripcion"
                       value="{{ old('pro_descripcion', $productos->pro_descripcion) }}"
                       class="form-control @error('pro_descripcion') is-invalid @enderror"
                       @if((auth()->check() && (auth()->user()->hasRole('gerente_compras') || auth()->user()->hasRole('gerente_ventas')) ))
                           readonly
                       @endif
                       required>
                @error('pro_descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PRECIO VENTA --}}
            @if(auth()->check() && auth()->user()->hasRole('gerente_ventas'))
                <div class="col-12 col-md-6">
                    <label>Precio de Venta:</label>
                    <input type="number"
                           name="pro_precio_venta"
                           class="form-control"
                           value="{{ old('pro_precio_venta', $productos->pro_precio_venta) }}"
                           min="1"
                           required>
                </div>
            @else
                <input type="hidden"
                       name="pro_precio_venta"
                       value="{{ $productos->pro_precio_venta }}">
            @endif

            {{-- PRECIO COMPRA --}}
            @if(auth()->check() && auth()->user()->hasRole('gerente_compras'))
                <div class="col-12 col-md-6">
                    <label>Precio de Compra:</label>
                    <input type="number"
                           name="pro_valor_compra"
                           class="form-control"
                           value="{{ old('pro_valor_compra', $productos->pro_valor_compra) }}"
                           min="1"
                           required>
                </div>
            @else
                <input type="hidden"
                       name="pro_valor_compra"
                       value="{{ $productos->pro_valor_compra }}">
            @endif

            {{-- CAMPOS GENERALES (NO GERENTES) --}}
            @unless((auth()->check() && (auth()->user()->hasRole('gerente_compras') || auth()->user()->hasRole('gerente_ventas')) ))

                {{-- TIPO --}}
                <div class="col-12 col-md-6">
                    <label>Tipo:</label>
                    <select name="tipo_Producto" class="form-control" required>
                        @foreach ($tiposProducto as $tipo)
                            <option value="{{ $tipo->id_tipo }}"
                                {{ old('tipo_Producto', $productos->id_tipo) == $tipo->id_tipo ? 'selected' : '' }}>
                                {{ $tipo->tipo_descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SALDO --}}
                <div class="col-12 col-md-6">
                    <label>Saldo Inicial:</label>
                    <input type="number"
                           name="saldo_inicial"
                           value="{{ old('saldo_inicial', $productos->pro_saldo_inicial) }}"
                           class="form-control"
                           required>
                </div>

                {{-- UM COMPRA --}}
                <div class="col-12 col-md-6">
                    <label>Unidad de Medida (Compra):</label>
                    <select name="unidad_medida_compra" class="form-control" required>
                        @foreach ($unidadesMedidas as $UM)
                            <option value="{{ $UM->id_unidad_medida }}"
                                {{ old('unidad_medida_compra', $productos->pro_um_compra) == $UM->id_unidad_medida ? 'selected' : '' }}>
                                {{ $UM->um_descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- UM VENTA --}}
                <div class="col-12 col-md-6">
                    <label>Unidad de Medida (Venta):</label>
                    <select name="unidad_medida_venta" class="form-control" required>
                        @foreach ($unidadesMedidas as $UM)
                            <option value="{{ $UM->id_unidad_medida }}"
                                {{ old('unidad_medida_venta', $productos->pro_um_venta) == $UM->id_unidad_medida ? 'selected' : '' }}>
                                {{ $UM->um_descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>

            @else
                {{-- HIDDEN PARA GERENTES --}}
                <input type="hidden" name="tipo_Producto" value="{{ $productos->id_tipo }}">
                <input type="hidden" name="saldo_inicial" value="{{ $productos->pro_saldo_inicial }}">
                <input type="hidden" name="unidad_medida_compra" value="{{ $productos->pro_um_compra }}">
                <input type="hidden" name="unidad_medida_venta" value="{{ $productos->pro_um_venta }}">
            @endunless

        </div>

        {{-- BOTONES --}}
        <div class="mt-4 d-flex gap-2">
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
