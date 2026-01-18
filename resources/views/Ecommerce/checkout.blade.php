@extends('layouts.content')

@section('content')
<div class="container py-4">
  <div class="row g-4">

    {{-- Datos cliente --}}
    <div class="col-12 col-lg-7">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3">Checkout</h4>

          <h6 class="mt-3 mb-2">Datos del cliente</h6>

          <div class="row g-3">
            <div class="col-12 col-md-6">
              <label class="form-label">Nombre</label>
              <input class="form-control" value="{{ $cliente->cli_nombre ?? auth()->user()->name }}" disabled>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Cédula/RUC</label>
              <input class="form-control" value="{{ $cliente->cli_ruc_ced ?? '' }}" disabled>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Teléfono</label>
              <input class="form-control" value="{{ $cliente->cli_telefono ?? '' }}" disabled>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Email</label>
              <input class="form-control" value="{{ $cliente->cli_email ?? auth()->user()->email }}" disabled>
            </div>

            <div class="col-12">
              <label class="form-label">Dirección</label>
              <input class="form-control" value="{{ $cliente->cli_direccion ?? '' }}" disabled>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- Resumen carrito --}}
    <div class="col-12 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Resumen del pedido</h5>

          <div id="checkout-items" class="d-flex flex-column gap-3">
            <div class="text-muted">Cargando carrito...</div>
          </div>

          <hr>

          <div class="d-flex justify-content-between">
            <span class="fw-semibold">Subtotal</span>
            <span class="fw-bold" id="checkout-subtotal">$0.00</span>
          </div>

          {{-- IVA --}}
          <div class="d-flex justify-content-between mt-2">
            <span class="fw-semibold">IVA (15%)</span>
            <span class="fw-bold" id="checkout-iva">$0.00</span>
          </div>

          <div class="d-flex justify-content-between mt-2">
            <span class="fw-semibold">Total</span>
            <span class="fw-bold" id="checkout-total">$0.00</span>
          </div>

          <form method="POST" action="{{ route('checkout.proceed') }}" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-dark w-100">
              Proceder al pago
            </button>
          </form>

          <a class="btn btn-outline-secondary w-100 mt-2" href="{{ route('carrito.index') }}">
            Volver al carrito
          </a>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
  const itemsWrap = document.getElementById('checkout-items');
  const subtotalEl = document.getElementById('checkout-subtotal');
  const ivaEl = document.getElementById('checkout-iva');
  const totalEl = document.getElementById('checkout-total');

  const IVA_RATE = 0.15;
  const money = (n) => `$${Number(n || 0).toFixed(2)}`;

  try {
    const res = await fetch('/carrito/data', {
      headers: { 'Accept': 'application/json' },
      credentials: 'same-origin'
    });

    if (!res.ok) {
      itemsWrap.innerHTML = `<div class="text-danger">No se pudo cargar el carrito.</div>`;
      return;
    }

    const data = await res.json();

    // OJO: tu API devuelve items con { producto: {...}, precio_unitario, cantidad }
    const items = data.items || [];
    const subtotal = Number(data.subtotal || 0);

    const iva = +(subtotal * IVA_RATE).toFixed(2);
    const total = +(subtotal + iva).toFixed(2);

    if (items.length === 0) {
      itemsWrap.innerHTML = `<div class="alert alert-warning mb-0">Tu carrito está vacío.</div>`;
      subtotalEl.textContent = money(0);
      ivaEl.textContent = money(0);
      totalEl.textContent = money(0);
      return;
    }

    itemsWrap.innerHTML = items.map(it => {
      const p = it.producto || {};
      const nombre = p.pro_descripcion || it.id_producto || '';
      const imgFile = p.img || '';
      const img = imgFile ? `/storage/products/${imgFile}` : '';

      const price = Number(it.precio_unitario || 0);
      const qty = Number(it.cantidad || 0);
      const line = price * qty;

      return `
        <div class="d-flex gap-3 align-items-center">
          <div style="width:64px;height:64px;border:1px solid #eee;border-radius:12px;overflow:hidden;flex:0 0 auto;display:flex;align-items:center;justify-content:center;">
            ${img ? `<img src="${img}" style="max-width:100%;max-height:100%;object-fit:contain;" onerror="this.outerHTML='<div class=&quot;text-muted small&quot;>Sin img</div>'">`
                  : `<div class="text-muted small">Sin img</div>`}
          </div>
          <div class="flex-grow-1">
            <div class="fw-semibold">${nombre}</div>
            <div class="text-muted small">${money(price)} c/u · x${qty}</div>
          </div>
          <div class="fw-bold">${money(line)}</div>
        </div>
      `;
    }).join('');

    subtotalEl.textContent = money(subtotal);
    ivaEl.textContent = money(iva);
    totalEl.textContent = money(total);

  } catch (e) {
    itemsWrap.innerHTML = `<div class="text-danger">Error cargando carrito.</div>`;
  }
});
</script>
@endsection
