<script>
document.addEventListener('DOMContentLoaded', () => {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;

    async function loadCartCount() {
        try {
            const res = await fetch('/carrito/data', {
                headers: { 'Accept': 'application/json' },
                credentials: 'same-origin'
            });

            if (!res.ok) {
                badge.textContent = badge.textContent || '0';
                badge.style.display = 'inline-block';
                badge.style.opacity = '0.35';
                return;
            }

            const data = await res.json();
            const count = Number(data.count || 0);

            badge.textContent = count;
            badge.style.display = 'inline-block';
            badge.style.opacity = count > 0 ? '1' : '0.35';
        } catch (e) {
            badge.textContent = badge.textContent || '0';
            badge.style.display = 'inline-block';
            badge.style.opacity = '0.35';
        }
    }

    loadCartCount();

    window.addEventListener('cart:updated', (e) => {
        const count = Number(e.detail?.count || 0);
        badge.textContent = count;
        badge.style.display = 'inline-block';
        badge.style.opacity = count > 0 ? '1' : '0.35';
    });
});
</script>

<style>
.cabecera {
    background-color: #0a2647;
}

.logo {
    max-width: 150px;
}

/* Mobile */
@media (max-width: 767px) {
    .cabecera {
        padding: 1.5rem 0;
    }

    .logo {
        max-width: 120px;
    }

    .mobile-search {
        margin-top: 1.5rem;
    }

    #cart-badge {
        font-size: 0.6rem;
    }
}
</style>

<header class="cabecera">
  <div class="container-fluid">

    <!-- Desktop Layout -->
    <div class="d-none d-md-block">
      <div class="row align-items-center py-2 py-md-3">
        <!-- Logo -->
        <div class="col-md-2">
          <a href="{{ route('portada.index') }}">
            <img src="{{ asset('img/Logo.png') }}"
                 alt="J-KADI Sports"
                 class="logo img-fluid">
          </a>
        </div>

        <!-- Menú Inicio -->
        <div class="col-md-1 text-center">
          <a href="{{ route('portada.index') }}" class="text-white text-decoration-none fw-normal">
            Inicio
          </a>
        </div>

        <!-- Menú Productos -->
        <div class="col-md-1 text-center">
          <a href="{{ route('catalogo.index') }}" class="text-white text-decoration-none fw-normal">
            Productos
          </a>
        </div>

        <!-- Buscador -->
        <div class="col-md-6">
          <form class="d-flex" role="search" method="GET" action="{{ route('catalogo.index') }}">
            <input class="form-control me-2 rounded-pill"
              type="search"
              placeholder="Buscar producto"
              name="search"
              value="{{ request('search') }}">
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
        <div class="col-md-1 text-center">
          <a href="{{ route('carrito.index') }}" class="text-decoration-none">
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

              <span id="cart-badge"
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size: 0.65rem;">
                0
              </span>

              <p class="text-white mb-0 mt-1 small">Carrito</p>
            </div>
          </a>
        </div>

        <!-- Usuario -->
        <div class="col-md-1 text-center">
          @auth
            <div class="dropdown d-inline-block">
              <div class="d-flex flex-column align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="35"
                    height="35"
                    fill="white"
                    class="bi bi-person-circle"
                    viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
                </svg>

                <button class="btn btn-link dropdown-toggle text-white p-0 mt-1"
                        type="button"
                        id="userDropdownPublic"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        style="text-decoration:none; font-size:0.85rem;">
                  {{ auth()->user()->name }}
                </button>

                <div class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="userDropdownPublic">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      Cerrar sesión
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @endauth

          @guest
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
          @endguest
        </div>
      </div>
    </div>

    <!-- Mobile Layout -->
    <div class="d-md-none">
      <!-- Logo centrado -->
      <div class="text-center mb-3">
        <a href="{{ route('portada.index') }}">
          <img src="{{ asset('img/Logo.png') }}"
               alt="J-KADI Sports"
               class="logo img-fluid">
        </a>
      </div>

      <!-- Buscador -->
      <div class="mobile-search">
        <form class="d-flex px-3" role="search" method="GET" action="{{ route('catalogo.index') }}">
          <input class="form-control me-2 rounded-pill"
            type="search"
            placeholder="Buscar"
            name="search"
            value="{{ request('search') }}">
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

      <!-- Menú inferior -->
      <div class="row mt-4 text-center">
        <!-- Productos -->
        <div class="col-4">
          <a href="{{ route('catalogo.index') }}" class="text-decoration-none">
            <div class="d-flex flex-column align-items-center">
              <p class="text-white mb-0 fw-normal" style="font-size: 1.1rem;">Productos</p>
            </div>
          </a>
        </div>

        <!-- Login -->
        <div class="col-4">
          @auth
            <div class="dropdown d-inline-block">
              <div class="d-flex flex-column align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="30"
                    height="30"
                    fill="white"
                    class="bi bi-person-circle mb-1"
                    viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8"/>
                </svg>
                <button class="btn btn-link dropdown-toggle text-white p-0"
                        type="button"
                        id="userDropdownMobile"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        style="text-decoration:none; font-size:0.9rem;">
                  Login
                </button>
                <div class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="userDropdownMobile">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      Cerrar sesión
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @endauth

          @guest
            <a href="{{ route('login.form') }}" class="text-decoration-none">
              <div class="d-flex flex-column align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                    fill="white" class="bi bi-person-circle mb-1" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                  <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0 A8 8 0 0 1 0 8
                       m8-7a7 7 0 0 0-5.468 11.37
                       C3.242 11.226 4.805 10 8 10
                       s4.757 1.225 5.468 2.37
                       A7 7 0 0 0 8 1"/>
                </svg>
                <p class="text-white mb-0 small">Login</p>
              </div>
            </a>
          @endguest
        </div>

        <!-- Carrito -->
        <div class="col-4">
          <a href="{{ route('carrito.index') }}" class="text-decoration-none">
            <div class="d-flex flex-column align-items-center position-relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                   fill="none" viewBox="0 0 24 24"
                   stroke="white" stroke-width="2" class="mb-1">
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

              <p class="text-white mb-0 small">Carrito</p>
            </div>
          </a>
        </div>
      </div>
    </div>

  </div>
</header>
