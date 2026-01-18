@extends('layouts.content')

@section('content')
    <div class="container my-5">

        {{-- Categorías (solo visual por ahora) --}}
        <div class="d-flex flex-wrap justify-content-center gap-4 mb-5">
            {{-- Botón para ver TODOS --}}
            <a href="{{ route('catalogo.index') }}" class="btn px-4 py-3 rounded-pill shadow-sm"
                style="background-color: {{ !request('categoria') ? '#0056b3' : '#031832' }}; color:white; margin: 10px;">
                Todos los productos
            </a>

            {{-- Botones de categorías --}}
            @foreach ($categorias as $categoria)
                <a href="{{ route('catalogo.index', ['categoria' => $categoria->id_tipo]) }}"
                    class="btn px-4 py-3 rounded-pill shadow-sm"
                    style="background-color: {{ request('categoria') == $categoria->id_tipo ? '#0056b3' : '#031832' }}; color:white; margin: 10px;">
                    {{ $categoria->tipo_descripcion }}
                </a>
            @endforeach
        </div>
        {{-- GRID DE PRODUCTOS --}}
        <div class="productos-grid">
            <div class="row g-4" style="margin-left: 0; margin-right: 0;">

                @foreach ($productos as $producto)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-2">
                        <a href="{{ route('catalogo.detalle', $producto->id_producto) }}" class="text-decoration-none"
                            style="color: inherit;">
                            <div class="card h-100 shadow-sm border-0 overflow-hidden">

                                {{-- Contenedor de imagen con fondo --}}
                                <div class="bg-light p-3"
                                    style="height: 220px; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('storage/products/' . $producto->img) }}" class="img-fluid"
                                        alt="{{ $producto->pro_descripcion }}"
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>

                                {{-- Cuerpo de la tarjeta --}}
                                <div class="card-body d-flex flex-column text-center p-3">

                                    {{-- Nombre del producto --}}
                                    <h6 class="card-title fw-bold mb-3" style="min-height: 48px; line-height: 1.4;">
                                        {{ Str::limit($producto->pro_descripcion, 50) }}
                                    </h6>

                                    {{-- Precio --}}
                                    <div class="mb-3 mt-auto">
                                        <p class="text-muted mb-1 small">Precio</p>
                                        <h5 class="fw-bold mb-0" style="color: #031832;">
                                            ${{ number_format($producto->pro_precio_venta, 2) }}
                                        </h5>
                                    </div>

                                    {{-- Botón de compra --}}
                                    <span class="btn w-100 text-white fw-semibold py-2 rounded-pill"
                                        style="background-color: #031832; transition: all 0.3s ease;">
                                        Comprar ahora
                                    </span>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>

        {{-- Paginación --}}

        <div class="pagination-wrapper d-flex justify-content-center mt-5">
            {{ $productos->links('pagination::bootstrap-5', ['class' => 'pagination pagination-sm']) }}

        </div>
        <p class="text-muted small text-center mt-2">
    Página {{ $productos->currentPage() }} de {{ $productos->lastPage() }} ·
    {{ $productos->total() }} productos
</p>
    </div>

    <style>
<style>
        /* CONTENEDOR */
.pagination {
    justify-content: center;
    gap: 6px;
}

.pagination + p,
p.text-sm.text-gray-700 {
    display: none;
}

/* BOTONES */
.page-link {
    color: #0d6efd;
    background-color: transparent;
    border: 1px solid #dee2e6;
    padding: 8px 14px;
    border-radius: 6px;
    transition: all 0.2s ease;
    font-weight: 500;
}

/* OCULTAR TEXTO "Showing x to y of z results" DE LARAVEL */
nav[aria-label="Pagination Navigation"] p,
.pagination-wrapper p,
.text-sm.text-gray-700,
.flex.justify-between p {
    display: none !important;
}


/* HOVER */
.page-link:hover {
    background-color: #e9ecef;
    color: #0a58ca;
}

p.text-sm.text-gray-700 {
    display: none;
}

ex
/* ACTIVO */
.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}

/* DESHABILITADO */
.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #f8f9fa;
    cursor: not-allowed;
}
    </style>


@endsection
