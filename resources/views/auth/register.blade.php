<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro | J-KADI SHOP</title>

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

        <!-- CARD REGISTER -->
        <div class="card mx-auto shadow w-100" style="max-width: 900px;">
            <div class="card-body p-3 p-md-4">

                <h5 class="text-center mb-4">Crear cuenta</h5>

                <form action="{{ route('register.store') }}" method="POST" novalidate>
                    @csrf
                    {{-- redirect para volver a checkout --}}
                    <input type="hidden" name="redirect" value="{{ old('redirect', $redirect ?? route('catalogo.index')) }}">

                    {{-- ALERTA para la verificación y autocompleto --}}
                    <div id="verifyAlert" class="alert d-none" role="alert"></div>

                    <div class="row g-3 text-start">

                        {{-- NOMBRE --}}
                        <div class="col-12 col-md-8">
                            <label class="form-label">Nombre *</label>
                            <input type="text"
                                   class="form-control @error('cli_nombre') is-invalid @enderror"
                                   name="cli_nombre"
                                   value="{{ old('cli_nombre') }}"
                                   required>
                            @error('cli_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- TIPO DOCUMENTO --}}
                        <div class="col-12 col-md-4">
                            <label class="form-label">Tipo de documento *</label>
                            <div class="d-flex gap-3 mt-2 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_documento" value="RUC"
                                           id="docRuc" {{ old('tipo_documento', 'RUC') == 'RUC' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="docRuc">RUC</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_documento" value="CEDULA"
                                           id="docCed" {{ old('tipo_documento') == 'CEDULA' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="docCed">Cédula</label>
                                </div>
                            </div>
                            @error('tipo_documento')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CEDULA/RUC --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Cédula / RUC *</label>

                            {{-- input y botón --}}
                            <div class="input-group">
                                <input type="text"
                                    name="cli_ruc_ced"
                                    id="cli_ruc_ced"
                                    inputmode="numeric"
                                    pattern="[0-9]*"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    class="form-control @error('cli_ruc_ced') is-invalid @enderror"
                                    value="{{ old('cli_ruc_ced') }}"
                                    required>

                                <button class="btn btn-outline-secondary" type="button" id="btnVerificar">
                                    Verificar
                                </button>
                            </div>

                            @error('cli_ruc_ced')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <div class="form-text" id="docHelp">RUC: 13 dígitos / Cédula: 10 dígitos</div>
                        </div>

                        {{-- TELEFONO --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Teléfono *</label>
                            <input type="text"
                                    name="cli_telefono"
                                    inputmode="numeric"
                                    pattern="[0-9]*"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
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

                            <select id="ciudad_select"
                                    name="ciudad_id"
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

                            {{-- input espejo para bloquear --}}
                            <input type="hidden" id="ciudad_hidden" name="ciudad_id_hidden">

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

                        {{-- DIRECCION --}}
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
                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Mínimo 8 caracteres"
                                   required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Confirmar contraseña *</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                    </div>

                    {{-- BOTONES --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-4">
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
