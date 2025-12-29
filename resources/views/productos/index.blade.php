@extends('layouts.contentAdmin')

@section('content')

@php
    $searchRoute = route('productos.index');
    $searchPlaceholder = 'Buscar productos...';
@endphp

<div>
    <h2>Listado de Productos</h2>
<div class="col-12 text-left">
    <a href="{{route('productos.create')}}" class="btn" style="background-color:#198754;color:white">Agregar Producto</a>

</div>

    <div class="table-responsive">
        <table id="tablaProductos" class="table table-striped table-bordered" >   
            <thead style="background-color:#031832;color:white"> 
                <tr>
                    <th>ID</th>
                    <th>Descripcion</th>
                    <th>Unidad de compra</th>
                    <th>Unidad de venta</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody style=" background-color:white;color:#031832 ;border-color:#031832" >
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id_producto }}</td>
                    <td>{{ $producto->pro_descripcion }}</td>
                    <td>{{ $producto->pro_um_compra }}</td>
                    <td>{{ $producto->pro_um_venta }}</td>
                    <td>{{ $producto->pro_saldo_final }}</td>
                    <td>
                    <div class="d-flex gap-1 justify-content-center">    
                        <a href="{{route('productos.edit', $producto->id_producto)}}"
                        class="btn btn-sm"
                        style="background-color:#031832;color:white; margin:2px;
                                padding: 4px 10px;
                                font-size: 0.8rem;
                                min-width: 65px;">
                            Editar                            
                        </a>



                        <form action="{{route('productos.destroy',$producto->id_producto)}}"
                            method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm"
                                    style="padding: 4px 10px; background-color:#8C0606;color:white; margin:2px;                                            font-size: 0.8rem;
                                       min-width: 65px;"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este Producto?')">
                                Eliminar
                            </button>
                        </form>



                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<div class="d-flex justify-content-center">
    {{ $productos->links('pagination::bootstrap-5') }}
</div>

</div>
@endsection