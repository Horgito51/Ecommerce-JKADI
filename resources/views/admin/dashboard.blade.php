@extends('layouts.contentAdmin')

@section('content')

<div class="container-fluid">

    <div class="card mb-4 shadow-sm">


        <div class="card-header text-center" style="background-color:#031832;">
            <h5 class="mb-0 text-white fw-semibold">
                Administrador J-KADI
            </h5>
            <small class="text-white-50">
                Acceso rápido a los módulos del sistema
            </small>
        </div>


        <div class="card-body">


            <div class="row g-4 justify-content-center">

                @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('gerente_compras')) )
                <div class="col-12 col-md-6 col-lg-3" style="margin:12px">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold" style="color:#031832">Compras</h5>
                            <p class="text-muted">
                                Gestión de órdenes de compra
                            </p>
                            <a href="{{ route('ordenes.index') }}"
                               class="btn btn-primary"
                               style="background-color:#031832;border-color:#031832;">
                                Ir a Órdenes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3" style="margin:12px">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold" style="color:#031832">Proveedores</h5>
                            <p class="text-muted">
                                Gestión de proveedores
                            </p>
                            <a href="{{ route('proveedores.index') }}"
                               class="btn btn-primary"
                               style="background-color:#031832;border-color:#031832;">
                                Ir a Proveedores
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                 @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('gerente_ventas')) )
                <div class="col-12 col-md-6 col-lg-3" style="margin:12px">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold" style="color:#031832">Ventas</h5>
                            <p class="text-muted">
                                Gestión de facturación
                            </p>
                            <a href="{{ route('facturas.index') }}"
                               class="btn btn-primary"
                               style="background-color:#031832;border-color:#031832;">
                                Ir a Facturas
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3" style="margin:12px">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold" style="color:#031832">Clientes</h5>
                            <p class="text-muted">
                                Gestión de clientes
                            </p>
                            <a href="{{ route('clientes.index') }}"
                               class="btn btn-primary"
                               style="background-color:#031832;border-color:#031832;">
                                Ir a Clientes
                            </a>
                        </div>
                    </div>
                </div>

                @endif

                <div class="col-12 col-md-6 col-lg-3" style="margin:12px">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold" style="color:#031832">Productos</h5>
                            <p class="text-muted">
                                Gestión de Catálogo y stock
                            </p>
                            <a href="{{ route('productos.index') }}"
                               class="btn btn-primary"
                               style="background-color:#031832;border-color:#031832;">
                                Ir a Productos
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
