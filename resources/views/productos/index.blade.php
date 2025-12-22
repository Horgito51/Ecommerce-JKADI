@extends('layouts.contentAdmin')

@section('content')

@php
    $searchRoute = route('productos.index');
    $searchPlaceholder = 'Buscar productos...';
@endphp

<div class="row justify-content-center">
    <h2>Listado de Productos</h2>
<div class="col-12 text-center">
    <a href="{{route('productos.create')}}" class="btn btn-outline-success w-50">
        Crear
    </a>
</div>

    <div class="table-responsive">
        <table border="3" id="tablaProductos" class="table table-dark table-striped">
                <tr>
                    <th>ID</th>
                    <th>Descripcion</th>
                    <th>Unidad de compra</th>
                    <th>Unidad de venta</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id_producto }}</td>
                    <td>{{ $producto->pro_descripcion }}</td>
                    <td>{{ $producto->pro_um_compra }}</td>
                    <td>{{ $producto->pro_um_venta }}</td>
                    <td>{{ $producto->pro_saldo_final }}</td>
                    <td>
                        <a href="{{route('productos.edit', $producto->id_producto)}}">
                        <button class="btn btn-outline-primary">Actualizar</button>
                        </a>
                    <form action="{{route('productos.destroy',$producto->id_producto)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>

                    </td>
                </tr>
                @endforeach
        </table>
    </div>

<div class="d-flex justify-content-center">
    {{ $productos->links('pagination::bootstrap-5') }}
</div>

</div>
@endsection