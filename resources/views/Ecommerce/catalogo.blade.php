@extends('layouts.content')

@section('content')

<div class="container my-5">

    {{-- Categorías (solo visual por ahora) --}}
    <div class="d-flex justify-content-center gap-2 mb-4">
        @foreach($categorias as $categoria)
        <button style="background-color:#031832; margin:5px" class="btn btn-dark">{{ $categoria->tipo_descripcion }}</button>
        @endforeach
    </div>
    {{-- GRID DE PRODUCTOS --}}
    <div class="row g-4">
        @foreach ($productos as $producto)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100 shadow-sm">

                    {{-- IMAGEN --}}
                    <img
                      src="{{ asset('storage/products/' . $producto->img) }}"
                        class="card-img-top img-fluid"
                        alt="{{ $producto->pro_descripcion }}"
                        style="height: 220px; object-fit: contain;"
                    >

                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">
                            {{ $producto->pro_descripcion }}
                        </h5>

                        <p class="text-muted mb-2">
                            Precio<br>
                            <strong>${{ number_format($producto->pro_precio_venta, 2) }}</strong>
                        </p>

                        <a style="background-color:#031832;"href="{{ route('catalogo.detalle', $producto->id_producto) }}" class="btn btn-primary w-100">
                            Comprar ahora
                        </a>
                    </div>

                </div>
            </div>
        @endforeach

    </div>

    {{-- PAGINACIÓN --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $productos->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
