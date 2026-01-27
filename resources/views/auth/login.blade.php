<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | J-KADI SHOP</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @media (max-width: 576px) {
            .card-body { padding: 1rem !important; }
        }
    </style>
</head>

<body style="background-color:#031832;">
<div class="container py-4 py-md-5">
    <div class="text-center">

        <!-- LOGO -->
        <a href="{{ route('portada.index') }}">
            <img src="{{ asset('img/Logo.png') }}" alt="J-KADI SHOP"
                 class="img-fluid mb-4"
                 style="max-width:320px; width:70vw;">
        </a>

        <!-- CARD LOGIN -->
        <div class="card mx-auto shadow w-100" style="max-width: 420px;">
            <div class="card-body p-3 p-md-4">

                <h5 class="text-center mb-4">Inicio de Sesión</h5>

                <form method="POST" action="{{ route('login.post') }}" novalidate>
                    @csrf
                    <input type="hidden" name="redirect"value="{{ old('redirect', request('redirect') ?? route('catalogo.index')) }}">
                    <!-- Correo -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="tu@email.com"
                            value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONTRASEÑA -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Contraseña</label>

                        <div class="input-group">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Ingresa tu contraseña">

                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>

                            @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mb-3">
                        <button type="submit" class="btn btn-light" id="loginBtn">
                            <span id="loginBtnText">Iniciar Sesión</span>
                            <span id="loginBtnSpinner" style="display:none; margin-left: 8px;">
                                <i class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></i>
                            </span>
                        </button>

                        <a href="{{ route('register.step1') }}" class="btn btn-primary">
                            Registrarse
                        </a>
                    </div>

                    <!-- OLVIDÓ CONTRASEÑA -->
                    <div class="text-center">
                        <a href="#" class="small text-decoration-none text-dark">
                            ¿Olvidó su contraseña?
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
