<header class="cabecera">
  <div class="container-fluid">
    <div class="row align-items-center py-2 py-md-3">

      <!-- Logo -->
      <div class="col-4 col-md-2 order-1">
        <a href="{{ route('portada.index') }}">
          <img src="{{ asset('img/Logo.png') }}"
               alt="J-KADI Sports"
               class="logo img-fluid"
               style="max-width: 150px;">
        </a>
      </div>

      <!-- Menú Productos -->
      <div class="col-4 col-md-1 order-2 text-center text-md-start">
        <a href="{{ route('catalogo.index') }}" class="text-white text-decoration-none fw-normal">
          Productos
        </a>
      </div>

      <!-- Buscador -->
      <div class="col-12 col-md-6 order-4 order-md-3 mt-3 mt-md-0">
        <form class="d-flex" role="search" method="GET" action="/productos">
          <input class="form-control me-2 rounded-pill"
                 type="search"
                 placeholder="Buscar producto"
                 name="q"
                 value="{{ request('q') }}">
          <button class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
                  type="submit"
                  style="width: 45px; height: 45px; flex-shrink: 0;">
            <img src="{{ asset('img/lupa.png') }}"
                 alt="Buscar"
                 width="20"
                 height="20">
          </button>
        </form>
      </div>

      <!-- Carrito -->
      <div class="col-2 col-md-1 order-3 order-md-4 text-center">
        <a href="#" class="text-decoration-none">
          <div class="d-flex flex-column align-items-center position-relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                 fill="none" viewBox="0 0 24 24"
                 stroke="white" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437
                   M7.5 14.25a3 3 0 0 0-3 3h15.75
                   m-12.75-3h11.218
                   c1.121-2.3 2.1-4.684 2.924-7.138
                   a60.114 60.114 0 0 0-16.536-1.84
                   M7.5 14.25 5.106 5.272
                   M6 20.25a.75.75 0 1 1-1.5 0
                   .75.75 0 0 1 1.5 0
                   Zm12.75 0a.75.75 0 1 1-1.5 0
                   .75.75 0 0 1 1.5 0Z"/>
            </svg>

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                  style="font-size: 0.65rem;">
              0
            </span>
            <p class="text-white mb-0 mt-1 small">Carrito</p>
          </div>
        </a>
      </div>

      <!-- Iniciar sesión -->
      <div class="col-2 col-md-2 order-5 text-center">
        <a href="{{ route('login.form') }}" class="text-decoration-none">
          <div class="d-flex flex-column align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0
                      3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0
                  A8 8 0 0 1 0 8
                  m8-7a7 7 0 0 0-5.468 11.37
                  C3.242 11.226 4.805 10 8 10
                  s4.757 1.225 5.468 2.37
                  A7 7 0 0 0 8 1"/>
            </svg>
            <p class="text-white mb-0 mt-1 small">Iniciar sesión</p>
          </div>
        </a>
      </div>

    </div>
  </div>
</header>
