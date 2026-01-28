<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro | Paso 2</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @media (max-width: 576px) {
            .card-body { padding: 1rem !important; }
            .form-text { font-size: .8rem; }
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

        <!-- CARD -->
        <div class="card mx-auto shadow w-100" style="max-width: 700px;">
            <div class="card-body p-3 p-md-4">

                <h5 class="text-center mb-2">Completar registro</h5>
                <p class="text-center text-muted mb-4">
                    Encontramos tu documento registrado como cliente.  
                    Para crear tu cuenta, ingresa tu correo y una contraseña.
                </p>

                @if (session('info'))
                    <div class="alert alert-info">{{ session('info') }}</div>
                @endif

                {{-- Errores generales --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Revisa los campos marcados e inténtalo nuevamente.
                    </div>
                @endif

                <form action="{{ route('register.existing.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- redirect --}}
                    <input type="hidden" name="redirect" value="{{ old('redirect', $redirect ?? route('catalogo.index')) }}">

                    {{-- Mantener tipo/doc en el request --}}
                    <input type="hidden" name="tipo_documento" value="{{ old('tipo_documento', $tipo_documento ?? 'RUC') }}">
                    <input type="hidden" name="cli_ruc_ced" value="{{ old('cli_ruc_ced', $cli_ruc_ced ?? '') }}">

                    <div class="row g-3 text-start">

                        {{-- DOCUMENTO (solo lectura) --}}
                        <div class="col-12">
                            <label class="form-label">Documento</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ old('cli_ruc_ced', $cli_ruc_ced ?? '') }}"
                                   disabled>
                            <div class="form-text">
                                Tipo: {{ old('tipo_documento', $tipo_documento ?? 'RUC') }}
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-12">
                            <label class="form-label">Email *</label>
                            <input type="email"
                                   name="cli_email"
                                   class="form-control @error('cli_email') is-invalid @enderror"
                                   value="{{ old('cli_email') }}"
                                   required>
                            @error('cli_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Debe coincidir con el correo registrado para este documento (si aplica).
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Contraseña *</label>

                            <div class="input-group">
                                <input type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Mínimo 8 caracteres"
                                    required>

                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye" id="toggleIconPassword"></i>
                                </button>
                            </div>

                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Confirmar contraseña *</label>

                            <div class="input-group">
                                <input type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    required>

                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                    <i class="bi bi-eye" id="toggleIconConfirm"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- BOTONES --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-4">
                        <button type="submit" class="btn btn-light">
                            Crear cuenta y continuar
                        </button>

                        {{-- volver al paso 1 (por si se equivocó de doc) --}}
                        <a href="{{ route('register.step1', ['redirect' => old('redirect', $redirect ?? route('catalogo.index'))]) }}"
                            class="btn btn-outline-dark">
                            Cambiar documento
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('login.form') }}" class="text-decoration-none text-light">
                            ¿Ya tienes cuenta? Inicia sesión
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/register-step2.js') }}"></script>

</body>
</html>
