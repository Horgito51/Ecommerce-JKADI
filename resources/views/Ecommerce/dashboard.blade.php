@extends('layouts.content')

@section('content')

<section class="container my-5">
    <div class="row align-items-center">

        <!-- COLUMNA TEXTO -->
        <div class="col-lg-6 col-md-12">

            <h1  style="color:#031832">
                <b>Tu supermercado  de confianza</b>
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
                    <h3 class="fw-bold"style="color:#031832">500+</h3>
                    <p style="color:#031832">Productos</p>
                </div>
                <div class="col">
                    <h3 class="fw-bold" style="color:#031832">10,000+</h3>
                    <p style="color:#031832">Clientes</p>
                </div>
                <div class="col">
                    <h3 class="fw-bold" style="color:#031832">24/7</h3>
                    <p style="color:#031832">Soporte</p>
                </div>
            </div>

        </div>

        <!-- COLUMNA IMAGEN -->
        <div class="col-lg-6 col-md-12 ">
            <img
                src="{{ asset('img/dashboard/Supermercado.png') }}"
                class="w-100% h-100% "
                alt="Supermercado JKADI">
        </div>

    </div>
</section>
<div style="width:100%; height:50px; background-color:#031832;"></div>

@endsection
