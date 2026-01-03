<header class="cabecera">
  <div class="container-fluid">
    <div class="row align-items-center py-3">

      <!-- Logo -->
      <div class="col-6 col-md-2">
       <a href="{{ route('admin.index') }}">
         <img src="{{ asset('img/Logo.png') }}"
             alt="J-KADI Sports"
             class="img-fluid"
             style="max-width: 140px;">
       </a>
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

      <!-- Buscador dinámico (GENÉRICO) -->
      <div class="col-12 col-md-5 mt-3 mt-md-0">
        <form class="d-flex"
              action="{{ $searchRoute ?? '#' }}"
              method="GET">

          {{-- 🔎 Parámetros extra opcionales (filtros, estados, etc.) --}}
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
        <div class="d-flex flex-column align-items-center">
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
          <small class="text-white mt-1">
           {{ auth()->user()->name ?? 'Administrador' }}
          </small>
        </div>
      </div>

    </div>
  </div>
</header>
