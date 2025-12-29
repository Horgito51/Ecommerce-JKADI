@extends('layouts.content')

@section('content')

<section class="container my-5">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 text-center text-md-start text-lg-start">
            <h1 style="color:#031832">
                <b>Tu supermercado de confianza</b>
            </h1>

             <div class="d-flex gap-3 my-3">
                <a class="btn" href="{{ route('catalogo.index') }}" style="background-color:#031832; color:white; border-radius:5px; margin:5px">
                    Comprar Ahora
                </a>
                <a class="btn" style="background-color:#031832; color:white; border-radius:5px; margin:5px">
                    Registrarse
                </a>
            </div>

            <div class="row text-center mt-4">
                <div class="col">
                    <h2 class="fw-bold" style="color:#031832; font-size:3rem">500+</h2>
                    <p style="color:#031832; font-size:1.5rem">Productos</p>
                </div>
                <div class="col">
                    <h2 class="fw-bold" style="color:#031832; font-size:3rem">10,000+</h2>
                    <p style="color:#031832; font-size:1.5rem">Clientes</p>
                </div>
                <div class="col">
                    <h2 class="fw-bold" style="color:#031832; font-size:3rem">24/7</h2>
                    <p style="color:#031832; font-size:1.5rem">Soporte</p>
                </div>
            </div>

        </div>

        <div class="col-lg-6 col-md-12">
            <img src="{{ asset('img/dashboard/Supermercado.png') }}" class="w-100" alt="Supermercado JKADI">
        </div>
    </div>
</section>

<div  class="w-100" style="width:100px; height:60px; background-color:#031832;" ></div>

<section class="container py-4">
    <h1 class="text-center mb-2" style="color:#031832">
        <b>¿Quiénes Somos?</b>
    </h1>
    <p class="text-center px-3" style="color:#031832; font-size:1.15rem">
        J-KADI es tu supermercado de confianza en Ecuador. Ofrecemos productos de consumo diario con calidad garantizada, catálogos actualizados especialmente para tu familia.
    </p>
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6 col-12" style="margin-bottom:15px">
            <div class="text-center p-4 h-100" style="background-color:#031832; border-radius:10px">
                <img src="{{ asset('img/dashboard/liston.png') }}" alt="Calidad" style="width:80px; height:80px; margin-bottom:20px">
                <h4 class="text-white mb-3"><b>Calidad</b></h4>
                <p class="text-white">Garantizamos productos frescos y buenos</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12" style="margin-bottom:15px">
            <div class="text-center p-4 h-100" style="background-color:#031832; border-radius:10px">
                <img src="{{ asset('img/dashboard/Escudo.png') }}" alt="Compra Segura" style="width:80px; height:80px; margin-bottom:20px">
                <h4 class="text-white mb-3"><b>Compra segura</b></h4>
                <p class="text-white">Protegemos tus datos y tus pagos</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12" style="margin-bottom:15px">
            <div class="text-center p-4 h-100" style="background-color:#031832; border-radius:10px">
                <img src="{{ asset('img/dashboard/camion.png') }}" alt="Envío Rápido" style="width:80px; height:80px; margin-bottom:20px">
                <h4 class="text-white mb-3"><b>Envío Rápido</b></h4>
                <p class="text-white">Productos en tu puerta en tiempo récord</p>
            </div>
        </div>

    </div>
</section>


@endsection
