@extends('layouts.content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="container-fluid bg-white min-vh-100 py-4">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');

        /* Zoom effect needs custom CSS as Bootstrap doesn't have it */
        .zoom-img-container {
            overflow: hidden;
            cursor: zoom-in;
        }
        .zoom-img-container img {
            transition: transform 0.3s ease;
        }
        .zoom-img-container:hover img {
            transform: scale(1.5);
        }

        /* Custom Font for Headings */
        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Playfair Display', serif !important;
        }
    </style>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <!-- Columna Izquierda: Flecha de regreso e Imagen -->
            <div class="col-lg-6 text-center position-relative">
                <!-- Flecha de regreso -->
                <div class="position-absolute top-0 start-0" style="z-index: 10;">
                    <a href="{{ route('catalogo.index') }}" class="btn btn-link text-dark fs-1 p-0">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Imagen del Producto -->
                <div class="d-flex align-items-center justify-content-center zoom-img-container" style="min-height: 500px;">
                    <img src="{{ asset('storage/products/' . $producto->img) }}"
                         alt="{{ $producto->pro_descripcion }}"
                         class="img-fluid"
                         style="max-height: 500px; object-fit: contain;"
                         onerror="this.src='{{ asset('storage/products/no-image.jpg') }}'">
                </div>
            </div>

            <!-- Columna Derecha: Información del Producto -->
            <div class="col-lg-5">
                <div class="ps-lg-4">
                    <!-- Nombre del Producto -->
                    <h1 class="h2 fw-bold mb-3">{{ $producto->pro_descripcion }}</h1>

                    <!-- Tag de Categoría -->
                    @if($producto->tipoProducto)
                        <div class="mb-3">
                            <span class="badge badge-success px-3 py-2">
                                {{ $producto->tipoProducto->tipo_descripcion }}
                            </span>
                        </div>
                    @endif

                    <!-- Precio -->
                    <div class="mb-4">
                        <div class="d-flex align-items-baseline">
                            <span class="text-muted mr-2" style="font-size: 1.5rem;">$</span>
                            <span class="font-weight-bold" style="font-size: 3rem; line-height: 1;">
                                {{ number_format($producto->pro_precio_venta, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <p class="text-muted">{{ $producto->pro_descripcion }}</p>
                        @if($producto->pro_saldo_final > 0)
                            <p class="text-muted small mb-0">
                                <i class="fas fa-check-circle text-success"></i>
                                Stock disponible: {{ $producto->pro_saldo_final }} unidades
                            </p>
                        @else
                            <p class="text-danger small mb-0">
                                <i class="fas fa-times-circle"></i>
                                Producto agotado
                            </p>
                        @endif
                    </div>

                    <!-- Selector de Cantidad (Bootstrap Input Group) -->
                    <div class="mb-4">
                        <div class="input-group" style="width: 150px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="btnMenos" {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <input type="number"
                                   class="form-control text-center font-weight-bold"
                                   id="cantidad"
                                   value="1"
                                   min="1"
                                   max="{{ $producto->pro_saldo_final }}"
                                   {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btnMas" {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Añadir -->
                    <div class="d-grid mb-4">
                        <button type="button"
                                class="btn btn-dark btn-lg btn-block rounded-pill py-3 font-weight-bold"
                                id="btnAgregarCarrito"
                                {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                            Añadir
                        </button>
                    </div>

                    <!-- Trust Signals / Badges (Bootstrap Grid & Alerts) -->
                    <div class="border-top pt-4">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center text-success">
                                    <i class="fas fa-store fa-2x mr-2"></i>
                                    <span class="small font-weight-bold">En Sucursales</span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center text-primary">
                                    <i class="fas fa-check-circle fa-2x mr-2"></i>
                                    <span class="small font-weight-bold">Recomendado</span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center text-secondary">
                                    <i class="fas fa-undo fa-2x mr-2"></i>
                                    <span class="small font-weight-bold">Devolución Gratis</span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center text-dark">
                                    <i class="fas fa-shield-alt fa-2x mr-2"></i>
                                    <span class="small font-weight-bold">Compra Segura</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Separator / Related Products Section -->
    <div class="container-fluid bg-light py-5 border-top">
        <div class="container">
            <h3 class="h4 font-weight-bold mb-4">Productos relacionados</h3>

            <div class="d-flex flex-nowrap overflow-auto pb-4" style="gap: 15px;">
                @php
                    $productosRelacionados = App\Models\Producto::where('id_tipo', $producto->id_tipo)
                        ->where('id_producto', '!=', $producto->id_producto)
                        ->where('estado_prod', 'ACT')
                        ->limit(10)
                        ->get();
                @endphp

                @forelse($productosRelacionados as $relacionado)
                    <div class="card border-0 shadow-sm flex-shrink-0" style="width: 260px;">
                        <a href="{{ route('catalogo.detalle', $relacionado->id_producto) }}" class="text-decoration-none">
                            <div class="card-body text-center p-3">
                                <div class="mb-3 d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <img src="{{ asset('storage/products/' . $relacionado->img) }}"
                                         alt="{{ $relacionado->pro_descripcion }}"
                                         class="img-fluid"
                                         style="max-height: 180px; object-fit: contain;"
                                         onerror="this.src='{{ asset('storage/products/no-image.jpg') }}'">
                                </div>
                                <h6 class="card-title text-dark font-weight-bold small mb-2 text-truncate">
                                    {{ $relacionado->pro_descripcion }}
                                </h6>
                                <p class="text-muted mb-0 font-weight-bold">
                                    ${{ number_format($relacionado->pro_precio_venta, 2) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No hay productos relacionados disponibles</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Script para los botones de cantidad -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputCantidad = document.getElementById('cantidad');
    const btnMenos = document.getElementById('btnMenos');
    const btnMas = document.getElementById('btnMas');
    const btnAgregarCarrito = document.getElementById('btnAgregarCarrito');
    const maxStock = {{ $producto->pro_saldo_final }};

    // Botón menos
    if (btnMenos) {
        btnMenos.addEventListener('click', function() {
            let valor = parseInt(inputCantidad.value);
            if (valor > 1) {
                inputCantidad.value = valor - 1;
            }
        });
    }

    // Botón más
    if (btnMas) {
        btnMas.addEventListener('click', function() {
            let valor = parseInt(inputCantidad.value);
            if (valor < maxStock) {
                inputCantidad.value = valor + 1;
            }
        });
    }

    // Validar input manual
    if (inputCantidad) {
        inputCantidad.addEventListener('change', function() {
            let valor = parseInt(this.value);
            if (isNaN(valor) || valor < 1) this.value = 1;
            if (valor > maxStock) this.value = maxStock;
        });
    }

    // Botón agregar al carrito (placeholder)
    if (btnAgregarCarrito) {
        btnAgregarCarrito.addEventListener('click', async function() {
            const cantidad = parseInt(inputCantidad.value, 10) || 1;

            // deshabilitar para evitar doble click
            btnAgregarCarrito.disabled = true;

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const res = await fetch('/carrito/add', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        id_producto: @json($producto->id_producto),
                        cantidad: cantidad
                    })
                });

                const data = await res.json().catch(() => ({}));

                if (!res.ok) {
                    // backend devuelve 422 con message (ej: stock insuficiente)
                    alert(data.message || 'No se pudo agregar al carrito.');
                    return;
                }
                // Opcional: si quieres ir al carrito directo:
                // window.location.href = "{{ route('carrito.index') }}";

                window.dispatchEvent(new CustomEvent('cart:updated', { detail: data }));
                if (window.CartDrawer) window.CartDrawer.open();

            } catch (e) {
                alert('Error de red al agregar al carrito.');
            } finally {
                btnAgregarCarrito.disabled = false;
            }
        });
    }
});
</script>
@endsection
