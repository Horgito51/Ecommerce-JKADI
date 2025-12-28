@extends('layouts.contentAdmin')
@section('content')
 <h2 style="color:#031832">Lista de Proveedores</h2>
    <div class="mb-3 gap-2 ">

        <a href="{{ route('proveedores.create') }}" class="btn" style="background-color:#198754;color:white">Agregar Cliente</a>
    </div>
    <div >
        <table class="table table-striped table-bordered" >
            <thead style="background-color:#031832;color:white">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>RUC/Cedula</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Ciudad</th>
                    <th>Celular</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody style=" background-color:white;color:#031832 ;border-color:#031832" >
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id_proveedor }}</td>
                        <td>{{ $proveedor->prv_nombre }}</td>
                        <td>{{ $proveedor->prv_ruc_ced }}</td>
                        <td>{{ $proveedor->prv_telefono }}</td>
                        <td>{{ $proveedor->prv_mail}}</td>
                        <td>{{ $proveedor->ciudades->ciu_descripcion}}</td>
                        <td>{{ $proveedor->prv_celular }}</td>
                        <td>{{ $proveedor->prv_direccion}}</td>
                        <td>
                            
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('proveedores.edit', $proveedor->id_proveedor) }}"
                            class="btn btn-sm"
                            style="background-color:#031832;color:white; margin:2px;
                                    padding: 4px 10px;
                                    font-size: 0.8rem;
                                    min-width: 65px;">
                                Editar
                            </a>

                            <form action="{{ route('proveedores.destroy', $proveedor) }}"
                                method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm"
                                        style="padding: 4px 10px; background-color:#8C0606;color:white; margin:2px;
                                            font-size: 0.8rem;
                                            min-width: 65px;"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este Proveedor?')">
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


@endsection
