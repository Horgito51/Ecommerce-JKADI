<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | J-KADI SHOP</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
                    <!-- USUARIO -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="log_usuario"
                               class="form-control @error('log_usuario') is-invalid @enderror"
                               placeholder="Ingrese su usuario"
                               value="{{ old('log_usuario') }}">
                        @error('log_usuario')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONTRASEÑA -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Ingrese su contraseña">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($errors->has('login'))
                        <div class="alert alert-danger text-center">
                            {{ $errors->first('login') }}
                        </div>
                    @endif

                    <!-- BOTONES -->
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mb-3">
                        <button type="submit" class="btn btn-light">
                            Iniciar Sesión
                        </button>

                        <a href="{{ route('register.form') }}" class="btn btn-primary">
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
</body>
</html>
