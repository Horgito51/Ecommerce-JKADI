<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- CSS propio desde public -->


    <title>J-KADI Shop - Productos de Calidad</title>
</head>

{{--CARRITO SIDEBAR--}}
<div id="cart-overlay" class="jk-overlay"></div>

<aside id="cart-drawer" class="jk-drawer">
  <div class="jk-drawer-header">
    <div class="jk-drawer-title">Tu carrito</div>
    <button type="button" class="jk-drawer-close" id="cart-close">✕</button>
  </div>

  <div class="jk-drawer-body">
    <div class="jk-muted" id="cart-drawer-summary">Cargando...</div>
    <div style="height:10px;"></div>
    <div id="cart-drawer-items"></div>
  </div>

  <div class="jk-drawer-footer">
    <div class="jk-drawer-row">
      <span class="jk-muted">Subtotal</span>
      <span class="jk-price" id="cart-drawer-subtotal">$0.00</span>
    </div>
    <button class="jk-btn jk-btn-primary" onclick="location.href='{{ route('carrito.index') }}'">
      Ver carrito
    </button>
    <button class="jk-btn jk-btn-danger" id="cart-clear">
      Vaciar
    </button>
  </div>
</aside>
{{--CARRITO SIDEBAR--}}

<script>
document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('cart-overlay');
  const drawer  = document.getElementById('cart-drawer');
  const btnClose = document.getElementById('cart-close');
  const btnClear = document.getElementById('cart-clear');

  const itemsBox = document.getElementById('cart-drawer-items');
  const subtotalEl = document.getElementById('cart-drawer-subtotal');
  const summaryEl = document.getElementById('cart-drawer-summary');

  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

  function money(v){ return '$' + Number(v || 0).toFixed(2); }

  function openDrawer(){
    overlay.classList.add('open');
    drawer.classList.add('open');
  }
  function closeDrawer(){
    overlay.classList.remove('open');
    drawer.classList.remove('open');
  }

  overlay?.addEventListener('click', closeDrawer);
  btnClose?.addEventListener('click', closeDrawer);
  document.addEventListener('keydown', (e) => { if(e.key === 'Escape') closeDrawer(); });

  async function api(url, { method='GET', body=null } = {}) {
    const headers = { 'Accept': 'application/json' };
    if (csrf) headers['X-CSRF-TOKEN'] = csrf;
    if (body) headers['Content-Type'] = 'application/json';

    const res = await fetch(url, {
      method,
      headers,
      body: body ? JSON.stringify(body) : null,
      credentials: 'same-origin',
    });

    const data = await res.json().catch(() => ({}));
    if (!res.ok) throw data;
    return data;
  }

  function renderDrawer(data){
    const items = (data.items || []).slice().sort((a, b) => {
    const na = (a.producto?.pro_descripcion || '').toString().trim().toLowerCase();
    const nb = (b.producto?.pro_descripcion || '').toString().trim().toLowerCase();

    // 1) ordenar por nombre
    const byName = na.localeCompare(nb, 'es');
    if (byName !== 0) return byName;

    // 2) desempate por id_producto (orden estable)
    return String(a.id_producto).localeCompare(String(b.id_producto));
    });
    summaryEl.textContent = `Items: ${Number(data.count || 0)}`;
    subtotalEl.textContent = money(data.subtotal || 0);

    if (!items.length){
      itemsBox.innerHTML = `<div class="jk-muted">Tu carrito está vacío.</div>`;
      return;
    }

    itemsBox.innerHTML = items.map(it => {
      const p = it.producto || {};
      // tu img real vive en /storage/products/
      const img = p.img ? `/storage/products/${p.img}` : '';
      const nombre = p.pro_descripcion || it.id_producto;
      const precio = Number(it.precio_unitario || 0);
      const qty = Number(it.cantidad || 0);

      return `
        <div class="jk-cart-item">
          ${img ? `<img src="${img}" alt="">` : `<div style="width:58px;height:58px;border-radius:12px;border:1px solid #eee;background:#fafafa;"></div>`}
          <div class="jk-cart-meta">
            <div class="jk-cart-title">${nombre}</div>
            <div class="jk-cart-line">
              <div class="jk-muted">${money(precio)} c/u</div>
              <div class="jk-price">${money(precio * qty)}</div>
            </div>

            <div class="jk-mini-qty">
              <button class="jk-btn jk-btn-sm" data-minus="${it.id_producto}">-</button>
              <input type="number" min="0" value="${qty}" data-input="${it.id_producto}">
              <button class="jk-btn jk-btn-sm" data-plus="${it.id_producto}">+</button>
              <button class="jk-btn jk-btn-sm" style="margin-left:auto;" data-remove="${it.id_producto}">Quitar</button>
            </div>
          </div>
        </div>
      `;
    }).join('');

    // listeners de botones (delegación simple)
    itemsBox.querySelectorAll('[data-minus]').forEach(b => {
      b.addEventListener('click', async () => {
        const id = b.getAttribute('data-minus');
        const input = itemsBox.querySelector(`[data-input="${id}"]`);
        const newQty = Math.max(0, (parseInt(input.value,10)||0) - 1);
        const updated = await api('/carrito/update', { method:'PATCH', body:{ id_producto:id, cantidad:newQty } });
        window.dispatchEvent(new CustomEvent('cart:updated', { detail: updated }));
      });
    });

    itemsBox.querySelectorAll('[data-plus]').forEach(b => {
      b.addEventListener('click', async () => {
        const id = b.getAttribute('data-plus');
        const input = itemsBox.querySelector(`[data-input="${id}"]`);
        const newQty = (parseInt(input.value,10)||0) + 1;
        const updated = await api('/carrito/update', { method:'PATCH', body:{ id_producto:id, cantidad:newQty } });
        window.dispatchEvent(new CustomEvent('cart:updated', { detail: updated }));
      });
    });

    itemsBox.querySelectorAll('[data-remove]').forEach(b => {
      b.addEventListener('click', async () => {
        const id = b.getAttribute('data-remove');
        const updated = await api(`/carrito/remove/${id}`, { method:'DELETE' });
        window.dispatchEvent(new CustomEvent('cart:updated', { detail: updated }));
      });
    });

    itemsBox.querySelectorAll('[data-input]').forEach(inp => {
      inp.addEventListener('keydown', async (e) => {
        if (e.key !== 'Enter') return;
        const id = inp.getAttribute('data-input');
        const newQty = Math.max(0, parseInt(inp.value,10)||0);
        const updated = await api('/carrito/update', { method:'PATCH', body:{ id_producto:id, cantidad:newQty } });
        window.dispatchEvent(new CustomEvent('cart:updated', { detail: updated }));
      });
    });
  }

  async function refreshDrawer(){
    try {
      const data = await api('/carrito/data');
      renderDrawer(data);
      return data;
    } catch(e) {
      itemsBox.innerHTML = `<div class="jk-muted">No se pudo cargar el carrito.</div>`;
      return null;
    }
  }

  // Vaciar
  btnClear?.addEventListener('click', async () => {
    const updated = await api('/carrito/clear', { method:'DELETE' });
    window.dispatchEvent(new CustomEvent('cart:updated', { detail: updated }));
  });

  // abrir drawer al hacer click en el icono del carrito (opcional)
  // Si tú quieres que el icono vaya a /carrito, NO actives esto.
  // Si quieres abrir sidebar, descomenta y ponle id al <a>:
  // document.getElementById('cart-link')?.addEventListener('click', async (e)=>{ e.preventDefault(); await refreshDrawer(); openDrawer(); });

  // Cada vez que se actualiza el carrito, refresca drawer (y badge lo actualiza tu script)
  window.addEventListener('cart:updated', async (e) => {
    // si el evento trae data, úsala directo (mejor)
    if (e.detail && e.detail.items) {
      renderDrawer(e.detail);
    } else {
      await refreshDrawer();
    }
  });

  // Exponer funciones globales para usarlas desde otras páginas
  window.CartDrawer = {
    open: async () => { await refreshDrawer(); openDrawer(); },
    close: () => closeDrawer(),
    refresh: async () => refreshDrawer(),
  };
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<body>

    @include('layouts.header')
    <div  class="container">
        @yield('content')
    </div>

    @include('layouts.footer')

</body>
</html>
