@extends('layouts.contentAdmin')

@section('content')
<div class="row justify-content-center">
    <h2>Listado de Productos</h2>
<table border="3" id="tablaProductos">
                <tr>
                    <th >Actualizar</th>
                    <th>Eliminar</th>
                    <th>ID</th>
                    <th>Descripcion</th>
                    <th>Unidad de compra</th>
                    <th>Unidad de venta</th>
                    <th>Stock</th>
                </tr>
                @foreach ($productos as $producto)
                <tr>
                    <td>
                        <a href="">
                        <button class="btn btn-primary">Actualizar</button>
                        </a>
                    </td>


                    <td>
                    <form action="">
                    @csrf
                    @method('PUT')
            <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>

                    
                    </td>
                    <td>{{ $producto->id_producto }}</td>
                    <td>{{ $producto->pro_descripcion }}</td>
                    <td>{{ $producto->pro_um_compra }}</td>
                    <td>{{ $producto->pro_um_venta }}</td>
                    <td>{{ $producto->pro_saldo_final }}</td>
                </tr>
                @endforeach
        </table>
</div>
@endsection