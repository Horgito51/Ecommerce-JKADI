<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro | J-KADI SHOP</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        <div class="card mx-auto shadow w-100" style="max-width: 900px;">
            <div class="card-body p-3 p-md-4">

                <h5 class="text-center mb-3">Crear cuenta</h5>

                <form action="{{ route('register.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- redirect --}}
                    <input type="hidden" name="redirect"
                           value="{{ old('redirect', $redirect ?? route('catalogo.index')) }}">

                    @php
                        $docPrefill  = old('cli_ruc_ced', $cli_ruc_ced ?? '');
                        $tipoPrefill = old('tipo_documento', $tipo_documento ?? 'RUC');
                        $vieneDelWizard = !empty($cli_ruc_ced);
                    @endphp

                    {{-- Hidden wizard (seguridad backend) --}}
                    @if($vieneDelWizard)
                        <input type="hidden" name="cli_ruc_ced_wizard" value="{{ $docPrefill }}">
                        <input type="hidden" name="tipo_documento_wizard" value="{{ $tipoPrefill }}">
                    @endif

                    <div class="row g-3 text-start">

                        {{-- NOMBRE --}}
                        <div class="col-12 col-md-8">
                            <label class="form-label">Nombre *</label>
                            <input type="text"
                                   name="cli_nombre"
                                   class="form-control @error('cli_nombre') is-invalid @enderror"
                                   value="{{ old('cli_nombre') }}"
                                   required>
                            @error('cli_nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- TIPO DOCUMENTO --}}
                        <div class="col-12 col-md-4">
                            <label class="form-label">Tipo de documento *</label>
                            <div class="d-flex gap-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="tipo_documento"
                                           value="RUC"
                                           {{ $tipoPrefill === 'RUC' ? 'checked' : '' }}
                                           {{ $vieneDelWizard ? 'disabled' : '' }}>
                                    <label class="form-check-label">RUC</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="tipo_documento"
                                           value="CEDULA"
                                           {{ $tipoPrefill === 'CEDULA' ? 'checked' : '' }}
                                           {{ $vieneDelWizard ? 'disabled' : '' }}>
                                    <label class="form-check-label">Cédula</label>
                                </div>
                            </div>

                            {{-- reenviar tipo si está disabled --}}
                            @if($vieneDelWizard)
                                <input type="hidden" name="tipo_documento" value="{{ $tipoPrefill }}">
                            @endif

                            @error('tipo_documento')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DOCUMENTO --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Cédula / RUC *</label>
                            <input type="text"
                                   name="cli_ruc_ced"
                                   class="form-control @error('cli_ruc_ced') is-invalid @enderror"
                                   value="{{ $docPrefill }}"
                                   {{ $vieneDelWizard ? 'readonly' : '' }}
                                   required>
                            @error('cli_ruc_ced')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- TELÉFONO --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Teléfono *</label>
                            <input type="text"
                                   name="cli_telefono"
                                   class="form-control @error('cli_telefono') is-invalid @enderror"
                                   value="{{ old('cli_telefono') }}"
                                   required>
                            @error('cli_telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CIUDAD --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Ciudad *</label>
                            <select name="ciudad_id"
                                    class="form-select @error('ciudad_id') is-invalid @enderror"
                                    required>
                                <option value="">Seleccione una ciudad</option>
                                @foreach ($ciudades as $ciudad)
                                    <option value="{{ $ciudad->id }}"
                                        {{ old('ciudad_id') == $ciudad->id ? 'selected' : '' }}>
                                        {{ $ciudad->ciu_descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ciudad_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email"
                                   name="cli_email"
                                   class="form-control @error('cli_email') is-invalid @enderror"
                                   value="{{ old('cli_email') }}"
                                   required>
                            @error('cli_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DIRECCIÓN --}}
                        <div class="col-12">
                            <label class="form-label">Dirección *</label>
                            <input type="text"
                                   name="cli_direccion"
                                   class="form-control @error('cli_direccion') is-invalid @enderror"
                                   value="{{ old('cli_direccion') }}"
                                   required>
                            @error('cli_direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Contraseña *</label>

                            <div class="input-group">
                                <input type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
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

                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="submit" class="btn btn-light">
                            Registrarme y continuar
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
<script src="{{ asset('js/register.js') }}"></script>

</body>
</html>
