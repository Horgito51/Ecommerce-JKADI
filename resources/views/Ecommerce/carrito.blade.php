@extends('layouts.content')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="jk-container">
    <div class="jk-header">
        <div>
            <h1 class="jk-title">Carrito</h1>
            <p class="jk-muted">Revisa tus productos, ajusta cantidades o elimina lo que no necesites.</p>
        </div>

        <div class="jk-actions">
            <a href="{{ route('catalogo.index') }}" class="jk-btn">Seguir comprando</a>
            <button class="jk-btn jk-btn-danger" id="btnClear">Vaciar carrito</button>
        </div>
    </div>

    <div style="height: 16px;"></div>

    <div class="jk-card">
        <div class="jk-summary">
            <span class="jk-muted" id="summary">Cargando...</span>
            <span class="jk-price" id="subtotalTop">$0.00</span>
        </div>

        <div style="height: 12px;"></div>

        <div class="jk-table-wrap">
            <table class="jk-table">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th class="jk-right">Total</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tbody">
                <tr><td colspan="5" class="jk-muted">Cargando...</td></tr>
                </tbody>
            </table>
        </div>

        <div class="jk-footer">
            <div class="jk-summary" style="width: 100%;">
                <span class="jk-muted">Subtotal</span>
                <span class="jk-price" id="subtotalBottom">$0.00</span>
            </div>

            <a href="{{ route('checkout.index') }}" id="btnCheckout" class="btn btn-dark w-100">
                Proceder al pago
            </a>
        </div>
    </div>
</div>

<div class="jk-toast" id="toast"></div>

<script>
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const state = { items: [], subtotal: 0, count: 0 };

    const money = (v) => '$' + Number(v || 0).toFixed(2);

    function toast(msg) {
        const el = document.getElementById('toast');
        el.textContent = msg;
        el.classList.add('show');
        setTimeout(() => el.classList.remove('show'), 2600);
    }

    async function api(url, { method='GET', body=null } = {}) {
        const headers = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrf,
        };
        if (body) headers['Content-Type'] = 'application/json';

        const res = await fetch(url, {
            method,
            headers,
            body: body ? JSON.stringify(body) : null,
            credentials: 'same-origin',
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
            if (data && data.message) toast(data.message);
            throw data;
        }

        return data;
    }

    function applyData(data) {
        state.items = data.items || [];
        state.subtotal = Number(data.subtotal || 0);
        state.count = Number(data.count || 0);

        document.getElementById('summary').textContent = `Items: ${state.count}`;
        document.getElementById('subtotalTop').textContent = money(state.subtotal);
        document.getElementById('subtotalBottom').textContent = money(state.subtotal);

        renderTable();
    }

    function renderTable() {
        const tbody = document.getElementById('tbody');

        if (!state.items.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="jk-muted">Tu carrito está vacío.</td></tr>`;
            return;
        }

        tbody.innerHTML = state.items.map(it => {
            const p = it.producto || {};
            const nombre = p.pro_descripcion || it.id_producto;
            const precio = Number(it.precio_unitario || 0);
            const total = precio * Number(it.cantidad || 0);
            const img = p.img ? `/storage/products/${p.img}` : '';

            return `
              <tr>
                <td>
                  <div class="jk-product">
                    ${img ? `<img class="jk-img" src="${img}" alt="">` : `<div class="jk-img"></div>`}
                    <div>
                      <div class="jk-product-name">${nombre}</div>
                    </div>
                  </div>
                </td>
                <td>${money(precio)}</td>
                <td>
                  <div class="jk-qty">
                    <button class="jk-btn jk-btn-sm" onclick="changeQty('${it.id_producto}', ${Number(it.cantidad) - 1})">-</button>
                    <input class="jk-input" type="number" min="0" value="${it.cantidad}"
                      onkeydown="if(event.key==='Enter'){ changeQty('${it.id_producto}', this.value) }">
                    <button class="jk-btn jk-btn-sm" onclick="changeQty('${it.id_producto}', ${Number(it.cantidad) + 1})">+</button>
                  </div>
                </td>
                <td class="jk-right jk-price">${money(total)}</td>
                <td class="jk-right">
                  <button class="jk-btn jk-btn-sm" onclick="removeItem('${it.id_producto}')">Quitar</button>
                </td>
              </tr>
            `;
        }).join('');
    }

    async function loadCart() {
        const data = await api('/carrito/data');
        applyData(data);
    }

    async function changeQty(id_producto, cantidad) {
        const qty = parseInt(cantidad, 10);
        if (Number.isNaN(qty) || qty < 0) return;

        const data = await api('/carrito/update', {
            method: 'PATCH',
            body: { id_producto, cantidad: qty }
        });

        applyData(data);
    }

    async function removeItem(id_producto) {
        const data = await api(`/carrito/remove/${id_producto}`, { method: 'DELETE' });
        applyData(data);
    }

    async function clearCart() {
        const data = await api('/carrito/clear', { method: 'DELETE' });
        applyData(data);
    }

    document.getElementById('btnClear').addEventListener('click', clearCart);

    document.getElementById('btnCheckout').addEventListener('click', () => {
        toast('Checkout pendiente de implementar');
    });

    loadCart().catch(() => toast('No se pudo cargar el carrito.'));
</script>
@endsection
