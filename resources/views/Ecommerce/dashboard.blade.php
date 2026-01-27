@extends('layouts.content')

@section('content')

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Pago realizado',
            text: @json(session('success')),
            showConfirmButton: true,
            timer: 3000,
            timerProgressBar: true,
        });
    });
</script>
@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json(session('error')),
            showConfirmButton: true,
        });
    });
</script>
@endif


<!-- HERO -->
<section class="container-fluid my-5" style="background-color:#F5F9FC">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
            <div class="text-center text-lg-start">
                <h1 class="display-3 display-md-2 display-lg-1 fw-bold mb-2" style="color:#031832">
                    Tu supermercado de confianza
                </h1>

                <p class="lead fs-4 fs-md-3 mb-4" style="color:#031832">
                    Encuentra todo lo que necesitas en un solo lugar, a buen precio y con excelente calidad.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start mb-4">
                    <a class="btn btn-lg px-4 py-2"
                       href="{{ route('catalogo.index') }}"
                       style="background-color:#031832; color:white; border-radius:5px;margin:10px">
                        Comprar Ahora
                    </a>
                    <a href="{{ route('register.step1') }}"
                    class="btn btn-lg px-4 py-2"
                    style="background-color:#031832; color:white; border-radius:5px;margin:10px">
                        Registrarse
                    </a>
                </div>

                <div class="row text-center mt-4 g-3">
                    <div class="col-4">
                        <h2 class="fw-bold" style="color:#031832">500+</h2>
                        <p style="color:#031832">Productos</p>
                    </div>
                    <div class="col-4">
                        <h2 class="fw-bold" style="color:#031832">10,000+</h2>
                        <p style="color:#031832">Clientes</p>
                    </div>
                    <div class="col-4">
                        <h2 class="fw-bold" style="color:#031832">24/7</h2>
                        <p style="color:#031832">Soporte</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <img src="{{ asset('img/dashboard/Supermercado.png') }}"
                 class="img-fluid w-100 rounded"
                 alt="Supermercado JKADI"
                 style="border-radius:10px;">
        </div>
    </div>
</section>

<!-- QUIÉNES SOMOS -->
<!-- Sección Quiénes Somos -->
 <section class="container py-5">
    <h2 class="text-center fw-bold mb-3 display-5 display-md-4" style="color:#031832"> ¿Quiénes Somos? </h2>
         <p style="text-align:center;color:#031832">
            J-KADI es tu supermercado de confianza en Ecuador. Ofrecemos productos de consumo diario con calidad garantizada,
            catálogos actualizados especialmente para tu familia. </p>

        <!-- Tarjetas de características -->
        <div class="row g-4 justify-content-center"> <!-- Calidad -->
             <div class="col-12 col-sm-6 col-lg-4" style="margin-bottom:15px">
                <div class="text-center p-4 h-100 rounded-3 hover-lift" style="background-color:#031832; transition: transform 0.3s ease;"> <img src="{{ asset('img/dashboard/liston.png') }}" alt="Calidad" class="mb-3" style="width:80px; height:80px">
                <h4 class="text-white fw-bold mb-3">Calidad</h4>
                <p class="text-white mb-0">Garantizamos productos frescos y buenos</p>
            </div>
        </div>
            <!-- Compra Segura -->
             <div class="col-12 col-sm-6 col-lg-4" style="margin-bottom:15px">
                <div class="text-center p-4 h-100 rounded-3 hover-lift"
                 style="background-color:#031832; transition: transform 0.3s ease;">
                 <img src="{{ asset('img/dashboard/Escudo.png') }}" alt="Compra Segura" class="mb-3" style="width:80px; height:80px">
                 <h4 class="text-white fw-bold mb-3">Compra segura</h4>
                 <p class="text-white mb-0">Protegemos tus datos y tus pagos</p>
                </div>
            </div>
            <!-- Envío Rápido -->
             <div class="col-12 col-sm-6 col-lg-4" style="margin-bottom:15px">
                <div class="text-center p-4 h-100 rounded-3 hover-lift"
                style="background-color:#031832; transition: transform 0.3s ease;">
                <img src="{{ asset('img/dashboard/camion.png') }}" alt="Envío Rápido" class="mb-3" style="width:80px; height:80px">
                 <h4 class="text-white fw-bold mb-3">Envío Rápido</h4>
                  <p class="text-white mb-0">Productos en tu puerta en tiempo récord</p>

 </div>
</div>
</div>
</section>

<!-- CATEGORÍAS -->
<section class="container-fluid my-5 p-4 rounded bg-light">

    <h3 class="text-center fw-bold mb-2" style="color:#031832">
        Encuentra lo que necesitas
    </h3>

    <p class="text-center fw-semibold mb-5" style="color:#031832">
        Si puedes imaginarlo, lo puedes encontrar en J-KADI.
    </p>

    <div class="row g-4 justify-content-center">

        <!-- Bebidas -->
@foreach ($categorias as $categoria)
    <div class="col-6 col-md-4 col-lg-3 mb-3">

        <a href="{{ route('catalogo.index', ['categoria' => $categoria['id']]) }}"
           class="text-decoration-none">

            <div class="card text-center h-100 border-0 shadow-sm rounded-4 hover-lift">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">

                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3"
                         style="width:70px; height:70px; background-color:#E8EEF5; color:#031832">
                        {!! $categoria['svg'] !!}
                    </div>

                    <h6 class="fw-bold mb-0" style="color:#031832">
                        {{ $categoria['nombre'] }}
                    </h6>

                </div>
            </div>

        </a>

    </div>
@endforeach


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
