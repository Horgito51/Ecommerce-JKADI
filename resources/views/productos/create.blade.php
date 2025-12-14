@extends('layouts.contentAdmin')
@section('content')

<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<label for="id_producto">Descripcion:</label>
<input type="text" id="id_producto" name="id_producto">
 <br>
    <label for="pro_descripcion">Descripcion producto</label>
    <input type="text" id='pro_descripcion' name='pro_descripcion'>

<br>
    <label for="tipo_Producto">TIPO:</label>
    <select name="tipo_Producto" id="tipo_Producto">
        <option value="">Seleccione Tipo</option>
        @foreach ($tiposProducto as $tipo)
            <option value="{{ $tipo->id_tipo }}">{{ $tipo->tipo_descripcion }}</option>
        @endforeach
    </select>

<br>
    <label for="unidad_medida_compra">UM COMPRA</label>
    <select name="unidad_medida_compra" id="unidad_medida_compra">
        <option value="">Seleccione Unidad de Medida</option>
        @foreach ($unidadesMedidas as $UM)
            <option value="{{ $UM->id_unidad_medida }}">{{ $UM->um_descripcion }}</option>
        @endforeach
    </select>
<br>
    <label for="unidad_medida_venta">UM VENTA</label>
    <select name="unidad_medida_venta" id="unidad_medida_venta">
        <option value="">Seleccione Unidad de Medida</option>
        @foreach ($unidadesMedidas as $UM)
            <option value="{{ $UM->id_unidad_medida }}">{{ $UM->um_descripcion }}</option>
        @endforeach
    </select>
<br>
    <label for="saldo_inicial">Saldo Inicial</label>
    <input type="text" id='saldo_inicial' name='saldo_inicial'>
<br>

<label for="img">Imagen del producto</label>
<br>
<input type="file" id="img" name="img" accept="image/*">
<br>
<input type="submit" enviar>

</form>
@endsection