<header class="cabecera">
  <div class="container-fluid">
    <div class="row align-items-center py-3">

      <!-- Logo -->
      <div class="col-6 col-md-2">
    @if(auth()->check() && (auth()->user()->hasRole('admin')))
       <a href="{{ route('admin.index') }}">
         <img src="{{ asset('img/Logo.png') }}"
             alt="J-KADI Sports"
             class="img-fluid"
             style="max-width: 140px;">
       </a>
       @elseif(auth()->check() && (auth()->user()->hasRole('gerente_compras')))
       <a href="{{ route('compras.index') }}">
         <img src="{{ asset('img/Logo.png') }}"
             alt="J-KADI Sports"
             class="img-fluid"
             style="max-width: 140px;">
       </a>
       @elseif(auth()->check() && (auth()->user()->hasRole('ventas')))
       <a href="{{ route('ventas.index') }}">
         <img src="{{ asset('img/Logo.png') }}"
             alt="J-KADI Sports"
             class="img-fluid"
             style="max-width: 140px;">
       </a>
       @elseif(auth()->check() && (auth()->user()->hasRole('gerente_bodega')))
       <a href="{{ route('bodega.index') }}">
         <img src="{{ asset('img/Logo.png') }}"
             alt="J-KADI Sports"
             class="img-fluid"
             style="max-width: 140px;">
       </a>
       @endif
      </div>

      <!-- Título Backoffice -->
      <div class="col-6 col-md-3 text-md-start text-end">
        <h6 class="text-white mb-0 fw-semibold">
          Panel Administrativo
        </h6>
        <small class="text-white-50 d-none d-md-block">
          Backoffice del sistema
        </small>
      </div>

      <!-- Buscador dinámico -->
      <div class="col-12 col-md-5 mt-3 mt-md-0">
        <form class="d-flex"
              action="{{ $searchRoute ?? '#' }}"
              method="GET">

          {{-- Parámetros extra opcionales (filtros, estados, etc.) --}}
          @isset($searchExtraParams)
            @foreach($searchExtraParams as $key => $val)
              @if(is_array($val))
                @foreach($val as $v)
                  <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                @endforeach
              @else
                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
              @endif
            @endforeach
          @endisset

          <input
            type="search"
            name="search"
            class="form-control me-2 rounded-pill"
            placeholder="{{ $searchPlaceholder ?? 'Buscar...' }}"
            value="{{ request('search') }}"
          >

          <button
            class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
            type="submit"
            style="width: 42px; height: 42px;">
            <img src="{{ asset('img/lupa.png') }}"
                 alt="Buscar"
                 width="18">
          </button>
        </form>
      </div>

      <!-- Usuario -->
      <div class="col-12 col-md-2 mt-3 mt-md-0 text-center">
        <div class="dropdown d-inline-block">

          <div class="d-flex flex-column align-items-center">

            <!-- SVG -->
            <svg xmlns="http://www.w3.org/2000/svg"
                width="34"
                height="34"
                fill="white"
                class="bi bi-person-circle"
                viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
            </svg>

            <!-- Pa que sea el boton dropdown del logout -->
            <button class="btn btn-link dropdown-toggle text-white p-0 mt-1"
                    type="button"
                    id="userDropdown"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
              {{ auth()->user()->name ?? 'Administrador' }}
            </button>

            <!-- MENÚ -->
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">Cerrar sesión</button>
              </form>
            </div>

          </div>
        </div>
      </div>


    </div>
  </div>
</header>
