<header class="cabecera">
  <div class="container-fluid">
    <div class="row align-items-center py-3">

      <!-- Logo -->
      <div class="col-6 col-md-2">
        <img src="{{ asset('img/Logo.png') }}"
             alt="J-KADI Sports"
             class="img-fluid"
             style="max-width: 140px;">
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

      <!-- Buscador (solo visual) -->
      <div class="col-12 col-md-5 mt-3 mt-md-0">
        <form class="d-flex">
          <input
            type="search"
            class="form-control me-2 rounded-pill"
            placeholder="Buscar productos, clientes o proveedores"
          >
          <button
            class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
            type="button"
            style="width: 42px; height: 42px;">
            <img src="{{ asset('img/lupa.png') }}"
                 alt="Buscar"
                 width="18">
          </button>
        </form>
      </div>

      <!-- Usuario (estático) -->
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
            Administrador
          </small>
        </div>
      </div>

    </div>
  </div>
</header>
