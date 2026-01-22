<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro | Paso 1</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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

                <h5 class="text-center mb-2">Crear cuenta</h5>
                <p class="text-center text-muted mb-4">
                    Ingresa tu documento para verificar si ya estás registrado como cliente.
                </p>

                {{-- Mensaje informativo (por ejemplo si vienes de algún redirect o flujo) --}}
                @if (session('info'))
                    <div class="alert alert-info">{{ session('info') }}</div>
                @endif

                <form action="{{ route('register.step1.check') }}" method="POST" novalidate>
                    @csrf

                    {{-- redirect para volver a checkout --}}
                    <input type="hidden" name="redirect" value="{{ old('redirect', $redirect ?? route('catalogo.index')) }}">

                    <div class="row g-3 text-start">

                        {{-- TIPO DOCUMENTO --}}
                        <div class="col-12">
                            <label class="form-label">Tipo de documento *</label>
                            <div class="d-flex gap-3 mt-2 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="tipo_documento"
                                           value="RUC"
                                           id="docRuc"
                                           {{ old('tipo_documento', 'RUC') === 'RUC' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="docRuc">RUC</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="tipo_documento"
                                           value="CEDULA"
                                           id="docCed"
                                           {{ old('tipo_documento') === 'CEDULA' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="docCed">Cédula</label>
                                </div>
                            </div>

                            @error('tipo_documento')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DOCUMENTO --}}
                        <div class="col-12">
                            <label class="form-label">Cédula / RUC *</label>
                            <input type="text"
                                   name="cli_ruc_ced"
                                   inputmode="numeric"
                                   pattern="[0-9]*"
                                   oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                   class="form-control @error('cli_ruc_ced') is-invalid @enderror"
                                   value="{{ old('cli_ruc_ced') }}"
                                   maxlength="13"
                                   required>

                            @error('cli_ruc_ced')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                RUC: 13 dígitos / Cédula: 10 dígitos
                            </div>
                        </div>

                    </div>

                    {{-- BOTONES --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-4">
                        <button type="submit" class="btn btn-light">
                            Siguiente
                        </button>

                        <a href="{{ route('login.form') }}" class="btn btn-primary">
                            Ya tengo cuenta
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
