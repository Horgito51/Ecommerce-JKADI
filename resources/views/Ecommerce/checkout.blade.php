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

          @if($items->isEmpty())
            <div class="alert alert-warning mb-3">Tu carrito está vacío.</div>
          @else
            <div class="d-flex flex-column gap-3">
              @foreach($items as $it)
                @php
                  $p = $it->producto;
                  $nombre = $p->pro_descripcion ?? $it->id_producto;
                  $img = !empty($p->img) ? "/storage/products/{$p->img}" : null;
                  $price = (float) $it->precio_unitario;
                  $qty = (int) $it->cantidad;
                  $line = $price * $qty;
                @endphp

                <div class="d-flex gap-3 align-items-center">
                  <div style="width:64px;height:64px;border:1px solid #eee;border-radius:12px;overflow:hidden;flex:0 0 auto;display:flex;align-items:center;justify-content:center;">
                    @if($img)
                      <img src="{{ $img }}" style="max-width:100%;max-height:100%;object-fit:contain;" onerror="this.outerHTML='<div class=&quot;text-muted small&quot;>Sin img</div>'">
                    @else
                      <div class="text-muted small">Sin img</div>
                    @endif
                  </div>

                  <div class="flex-grow-1">
                    <div class="fw-semibold">{{ $nombre }}</div>
                    <div class="text-muted small">${{ number_format($price, 2) }} c/u · x{{ $qty }}</div>
                  </div>

                  <div class="fw-bold">${{ number_format($line, 2) }}</div>
                </div>
              @endforeach
            </div>
          @endif

          <hr>

          <div class="d-flex justify-content-between">
            <span class="fw-semibold">Subtotal</span>
            <span class="fw-bold">${{ number_format($subtotal, 2) }}</span>
          </div>

          <div class="d-flex justify-content-between mt-2">
            <span class="fw-semibold">IVA</span>
            <span class="fw-bold">${{ number_format($iva, 2) }}</span>
          </div>

          <div class="d-flex justify-content-between mt-2">
            <span class="fw-semibold">Total</span>
            <span class="fw-bold">${{ number_format($total, 2) }}</span>
          </div>

          {{-- Abre modal --}}
          <button type="button"
                  class="btn btn-dark w-100 mt-3"
                  id="btnOpenPay"
                  {{ $items->isEmpty() ? 'disabled' : '' }}>
            Pagar
          </button>

          <a class="btn btn-outline-secondary w-100 mt-2" href="{{ route('carrito.index') }}">
            Volver al carrito
          </a>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="payModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Pago con tarjeta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-info py-2 mb-3">
          Simulación
        </div>

        <form id="payForm" method="POST" action="{{ route('checkout.proceed') }}" novalidate>
          @csrf

          <div class="mb-3">
            <label class="form-label">Nombre en la tarjeta</label>
            <input type="text" class="form-control" id="cardName" name="card_name" placeholder="Ej: Danny Yánez" required>
            <div class="invalid-feedback">Ingrese el nombre del titular.</div>
          </div>

          <div class="mb-3">
            <label class="form-label">Número de tarjeta</label>
            <input type="text" class="form-control" id="cardNumber" name="card_number"
                   inputmode="numeric" placeholder="1234 5678 9012 3456" maxlength="19" required>
            <div class="invalid-feedback">Número inválido (deben ser 16 dígitos).</div>
          </div>

          <div class="row g-3">
            <div class="col-6">
              <label class="form-label">Expira (MM/YY)</label>
              <input type="text" class="form-control" id="cardExp" name="card_exp" placeholder="MM/YY" maxlength="5" required>
              <div class="invalid-feedback">Fecha inválida o vencida.</div>
            </div>

            <div class="col-6">
              <label class="form-label">CVV</label>
              <input type="password" class="form-control" id="cardCvv" name="card_cvv"
                     inputmode="numeric" placeholder="123" maxlength="3" required>
              <div class="invalid-feedback">CVV inválido (3 dígitos).</div>
            </div>
          </div>

          <div class="mt-3">
            <div class="d-flex justify-content-between">
              <span class="fw-semibold">Total a pagar</span>
              <span class="fw-bold">${{ number_format($total, 2) }}</span>
            </div>
          </div>

          <div class="alert alert-success mt-3 d-none" id="paySuccess">
            Pago simulado exitoso
          </div>

          <button type="submit" class="btn btn-dark w-100 mt-3" id="btnConfirmPay">
            Confirmar pago
          </button>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="{{ asset('js/checkout.js') }}"></script>
@endsection