@extends('layouts.content')

@section('content')

<section class="container my-5">
    <div class="row align-items-center">
        <!-- Contenido de texto -->
        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
            <div class="text-center text-lg-start">
                <h1 class="display-3 display-md-2 display-lg-1 fw-bold mb-3" style="color:#031832">
                    Tu supermercado de confianza
                </h1>

                <p class="lead fs-4 fs-md-3 mb-4" style="color:#031832">
                    Encuentra todo lo que necesitas en un solo lugar, a buen precio y con excelente calidad.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start mb-4">
                    <a class="btn btn-lg px-4 py-2" href="{{ route('catalogo.index') }}" style="background-color:#031832; color:white; border-radius:5px; margin:5px">
                        Comprar Ahora
                    </a>
                    <a class="btn btn-lg px-4 py-2" style="background-color:#031832; color:white; border-radius:5px; margin:5px">
                        Registrarse
                    </a>
                </div>

                <!-- Estadísticas -->
                <div class="row text-center mt-4 mt-lg-5 g-3">
                    <div class="col-4">
                        <h2 class="fw-bold display-4 display-md-3 mb-1" style="color:#031832">500+</h2>
                        <p class="fs-6 fs-md-5 mb-0" style="color:#031832">Productos</p>
                    </div>
                    <div class="col-4">
                        <h2 class="fw-bold display-4 display-md-3 mb-1" style="color:#031832">10,000+</h2>
                        <p class="fs-6 fs-md-5 mb-0" style="color:#031832">Clientes</p>
                    </div>
                    <div class="col-4">
                        <h2 class="fw-bold display-4 display-md-3 mb-1" style="color:#031832">24/7</h2>
                        <p class="fs-6 fs-md-5 mb-0" style="color:#031832">Soporte</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Imagen -->
        <div class="col-lg-6 col-md-12">
            <img src="{{ asset('img/dashboard/Supermercado.png') }}"
                 class="img-fluid w-100 rounded"
                 alt="Supermercado JKADI" style="object-fit: cover; height: 100%; border-radius: 10px;">
        </div>
    </div>
</section>

<!-- Separador -->
<div class="w-100 py-4" style="background-color:#031832"></div>

<!-- Sección Quiénes Somos -->
<section class="container py-5">
    <h2 class="text-center fw-bold mb-3 display-5 display-md-4" style="color:#031832">
        ¿Quiénes Somos?
    </h2>

    <p class="text-center px-3 px-md-5 mb-5 fs-5 fs-md-4" style="color:#031832">
        J-KADI es tu supermercado de confianza en Ecuador. Ofrecemos productos de consumo diario con calidad garantizada, catálogos actualizados especialmente para tu familia.
    </p>

    <!-- Tarjetas de características -->
    <div class="row g-4 justify-content-center">
        <!-- Calidad -->
        <div class="col-12 col-sm-6 col-lg-4" style="margin-bottom:15px">
            <div class="text-center p-4 h-100 rounded-3 hover-lift" style="background-color:#031832; transition: transform 0.3s ease;">
                <img src="{{ asset('img/dashboard/liston.png') }}"
                     alt="Calidad"
                     class="mb-3"
                     style="width:80px; height:80px">
                <h4 class="text-white fw-bold mb-3">Calidad</h4>
                <p class="text-white mb-0">Garantizamos productos frescos y buenos</p>
            </div>
        </div>

        <!-- Compra Segura -->
        <div class="col-12 col-sm-6 col-lg-4" style="margin-bottom:15px">
            <div class="text-center p-4 h-100 rounded-3 hover-lift" style="background-color:#031832; transition: transform 0.3s ease;">
                <img src="{{ asset('img/dashboard/Escudo.png') }}"
                     alt="Compra Segura"
                     class="mb-3"
                     style="width:80px; height:80px">
                <h4 class="text-white fw-bold mb-3">Compra segura</h4>
                <p class="text-white mb-0">Protegemos tus datos y tus pagos</p>
            </div>
        </div>

        <!-- Envío Rápido -->
        <div class="col-12 col-sm-6 col-lg-4" style="margin-bottom:15px">
            <div class="text-center p-4 h-100 rounded-3 hover-lift" style="background-color:#031832; transition: transform 0.3s ease;">
                <img src="{{ asset('img/dashboard/camion.png') }}"
                     alt="Envío Rápido"
                     class="mb-3"
                     style="width:80px; height:80px">
                <h4 class="text-white fw-bold mb-3">Envío Rápido</h4>
                <p class="text-white mb-0">Productos en tu puerta en tiempo récord</p>
            </div>
        </div>
    </div>
</section>

<style>
.hover-lift {
    transition: transform 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-10px);
}
</style>

@endsection
