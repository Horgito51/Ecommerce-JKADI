@extends('layouts.contentAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Crear Producto</h2>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row g-3">

            {{-- ID Producto 
            <div class="col-12 col-md-6">
                <label for="id_producto">ID Producto: <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="id_producto" 
                    name="id_producto" 
                    class="form-control @error('id_producto') is-invalid @enderror" 
                    value="{{ old('id_producto') }}"
                    required
                >
                @error('id_producto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            --}}

            
            {{-- Descripción Producto --}}
            <div class="col-12 col-md-6">
                <label for="pro_descripcion">Descripción Producto: <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="pro_descripcion" 
                    name="pro_descripcion" 
                    class="form-control @error('pro_descripcion') is-invalid @enderror" 
                    value="{{ old('pro_descripcion') }}"
                    required
                >
                @error('pro_descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tipo de Producto --}}
            <div class="col-12 col-md-6">
                <label for="tipo_Producto">Tipo: <span class="text-danger">*</span></label>
                <select 
                    name="tipo_Producto" 
                    id="tipo_Producto" 
                    class="form-control @error('tipo_Producto') is-invalid @enderror" 
                    required
                >
                    <option value="">Seleccione Tipo</option>
                    @foreach ($tiposProducto as $tipo)
                        <option value="{{ $tipo->id_tipo }}" {{ old('tipo_Producto') == $tipo->id_tipo ? 'selected' : '' }}>
                            {{ $tipo->tipo_descripcion }}
                        </option>
                    @endforeach
                </select>
                @error('tipo_Producto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Saldo Inicial --}}
            <div class="col-12 col-md-6">
                <label for="saldo_inicial">Saldo Inicial: <span class="text-danger">*</span></label>
                <input 
                    type="number" 
                    id="saldo_inicial" 
                    name="saldo_inicial" 
                    class="form-control @error('saldo_inicial') is-invalid @enderror" 
                    value="{{ old('saldo_inicial') }}"
                    required
                >
                @error('saldo_inicial')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Unidad de Medida (Compra) --}}
            <div class="col-12 col-md-6">
                <label for="unidad_medida_compra">Unidad de Medida (Compra): <span class="text-danger">*</span></label>
                <select 
                    name="unidad_medida_compra" 
                    id="unidad_medida_compra" 
                    class="form-control @error('unidad_medida_compra') is-invalid @enderror" 
                    required
                >
                    <option value="">Seleccione Unidad de Medida</option>
                    @foreach ($unidadesMedidas as $UM)
                        <option value="{{ $UM->id_unidad_medida }}" {{ old('unidad_medida_compra') == $UM->id_unidad_medida ? 'selected' : '' }}>
                            {{ $UM->um_descripcion }}
                        </option>
                    @endforeach
                </select>
                @error('unidad_medida_compra')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Unidad de Medida (Venta) --}}
            <div class="col-12 col-md-6">
                <label for="unidad_medida_venta">Unidad de Medida (Venta): <span class="text-danger">*</span></label>
                <select 
                    name="unidad_medida_venta" 
                    id="unidad_medida_venta" 
                    class="form-control @error('unidad_medida_venta') is-invalid @enderror" 
                    required
                >
                    <option value="">Seleccione Unidad de Medida</option>
                    @foreach ($unidadesMedidas as $UM)
                        <option value="{{ $UM->id_unidad_medida }}" {{ old('unidad_medida_venta') == $UM->id_unidad_medida ? 'selected' : '' }}>
                            {{ $UM->um_descripcion }}
                        </option>
                    @endforeach
                </select>
                @error('unidad_medida_venta')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Imagen del Producto --}}
            <div class="col-12">
                <label for="img">Imagen del Producto:</label>
                <input 
                    type="file" 
                    id="img" 
                    name="img" 
                    accept="image/*" 
                    class="form-control @error('img') is-invalid @enderror"
                >
                @error('img')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Botones --}}
        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
            </button>

            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection