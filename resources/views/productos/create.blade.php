@extends('layouts.contentAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Crear Producto</h2>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="id_producto">ID Producto:</label>
            <input type="text" id="id_producto" name="id_producto" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="pro_descripcion">Descripción Producto:</label>
            <input type="text" id="pro_descripcion" name="pro_descripcion" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="tipo_Producto">Tipo:</label>
            <select name="tipo_Producto" id="tipo_Producto" class="form-control" required>
                <option value="">Seleccione Tipo</option>
                @foreach ($tiposProducto as $tipo)
                    <option value="{{ $tipo->id_tipo }}">{{ $tipo->tipo_descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="unidad_medida_compra">Unidad de Medida (Compra):</label>
            <select name="unidad_medida_compra" id="unidad_medida_compra" class="form-control" required>
                <option value="">Seleccione Unidad de Medida</option>
                @foreach ($unidadesMedidas as $UM)
                    <option value="{{ $UM->id_unidad_medida }}">{{ $UM->um_descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="unidad_medida_venta">Unidad de Medida (Venta):</label>
            <select name="unidad_medida_venta" id="unidad_medida_venta" class="form-control" required>
                <option value="">Seleccione Unidad de Medida</option>
                @foreach ($unidadesMedidas as $UM)
                    <option value="{{ $UM->id_unidad_medida }}">{{ $UM->um_descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="saldo_inicial">Saldo Inicial:</label>
            <input type="number" id="saldo_inicial" name="saldo_inicial" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="img">Imagen del Producto:</label>
            <input type="file" id="img" name="img" accept="image/*" class="form-control-file">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
