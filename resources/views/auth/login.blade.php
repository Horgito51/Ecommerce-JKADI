<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | J-KADI SHOP</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100"
      style="background-color:#031832;">

    <div class="text-center w-100">

        <!-- LOGO -->
        <a href="{{ route('portada.index') }}">
        <img src="{{ asset('img/Logo.png') }}" alt="J-KADI SHOP"
             class="mb-4" style="max-width:400px;">
        </a>

        <!-- CARD LOGIN -->
        <div class="card mx-auto shadow" style="max-width:360px;">
            <div class="card-body">

                <h5 class="text-center mb-4">Inicio de Sesión</h5>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <!-- USUARIO -->
                    <div class="mb-3 text-start">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="name"
                               class="form-control"
                               placeholder="Value"
                               required>
                    </div>

                    <!-- CONTRASEÑA -->
                    <div class="mb-4 text-start">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Value"
                               required>
                    </div>

                    <!-- BOTONES -->
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <button type="submit" class="btn btn-light btn-sm">
                            Iniciar Sesión
                        </button>

                        <button type="button" class="btn btn-primary btn-sm" disabled>
                            Registrarse
                        </button>
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

</body>
</html>
