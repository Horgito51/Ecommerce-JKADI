@extends('layouts.content')

@section('content')
<div class="container-fluid bg-white min-vh-100 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Columna Izquierda: Flecha de regreso e Imagen -->
            <div class="col-lg-6 text-center position-relative">
                <!-- Flecha de regreso -->
                <div class="position-absolute top-0 start-0">
                    <a href="{{ route('catalogo.index') }}" class="btn btn-link text-dark fs-1 p-0">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Imagen del Producto -->
                <div class="d-flex align-items-center justify-content-center" style="min-height: 500px;">
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
                            <span class="badge bg-success text-white px-3 py-2">
                                {{ $producto->tipoProducto->tipo_descripcion }}
                            </span>
                        </div>
                    @endif

                    <!-- Precio -->
                    <div class="mb-4">
                        <div class="d-flex align-items-baseline">
                            <span class="text-muted me-2" style="font-size: 1.5rem;">$</span>
                            <span class="fw-bold" style="font-size: 3rem; line-height: 1;">
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

                    <!-- Selector de Cantidad -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center bg-light rounded-pill p-2" style="width: fit-content;">
                            <button class="btn btn-light rounded-circle" 
                                    type="button" 
                                    id="btnMenos"
                                    style="width: 40px; height: 40px;"
                                    {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-minus"></i>
                            </button>
                            
                            <input type="number" 
                                   class="form-control border-0 bg-light text-center fw-bold mx-2" 
                                   id="cantidad" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $producto->pro_saldo_final }}"
                                   style="width: 60px;"
                                   {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                            
                            <button class="btn btn-light rounded-circle" 
                                    type="button" 
                                    id="btnMas"
                                    style="width: 40px; height: 40px;"
                                    {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Botón Añadir -->
                    <div class="d-grid">
                        <button type="button" 
                                class="btn btn-dark btn-lg rounded-pill py-3 fw-semibold"
                                id="btnAgregarCarrito"
                                {{ $producto->pro_saldo_final == 0 ? 'disabled' : '' }}>
                            Añadir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Relacionados -->
        <div class="mt-5 pt-5">
            <h3 class="h4 fw-bold mb-4">Productos relacionados</h3>
            
            <div class="row g-4">
                @php
                    $productosRelacionados = App\Models\Producto::where('id_tipo', $producto->id_tipo)
                        ->where('id_producto', '!=', $producto->id_producto)
                        ->where('estado_prod', 'ACT')
                        ->limit(4)
                        ->get();
                @endphp

                @forelse($productosRelacionados as $relacionado)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('catalogo.detalle', $relacionado->id_producto) }}" class="text-decoration-none">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-body text-center p-3">
                                    <div class="mb-3" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset('storage/products/' . $relacionado->img) }}" 
                                             alt="{{ $relacionado->pro_descripcion }}"
                                             class="img-fluid"
                                             style="max-height: 150px; object-fit: contain;"
                                             onerror="this.src='{{ asset('storage/products/no-image.jpg') }}'">
                                    </div>
                                    <h6 class="card-title text-dark fw-semibold small mb-2" style="height: 40px; overflow: hidden;">
                                        {{ Str::limit($relacionado->pro_descripcion, 50) }}
                                    </h6>
                                    <p class="text-muted mb-0 small">
                                        ${{ number_format($relacionado->pro_precio_venta, 2) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">No hay productos relacionados disponibles</p>
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
        btnAgregarCarrito.addEventListener('click', function() {
            const cantidad = inputCantidad.value;
            alert(`¡Producto agregado al carrito!\n\nProducto: {{ $producto->pro_descripcion }}\nCantidad: ${cantidad}\nPrecio: ${{ number_format($producto->pro_precio_venta, 2) }}\n\n(Funcionalidad del carrito pendiente de implementar)`);
        });
    }
});
</script>
@endsection
