@extends('layouts.content')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="jk-container">
    <!-- Contenedor de alertas -->
    <div id="alertContainer" style="margin-bottom: 20px;"></div>

    <div class="jk-header">
        <div>
            <h1 class="jk-title">Carrito</h1>
            <p class="jk-muted">Revisa tus productos, ajusta cantidades o elimina lo que no necesites.</p>
        </div>

        <div class="jk-actions">
            <a href="{{ route('catalogo.index') }}" class="jk-btn">Seguir comprando</a>
            <button class="jk-btn jk-btn-danger" id="btnClear" data-bs-toggle="modal" data-bs-target="#confirmClearModal">
                Vaciar carrito
            </button>
        </div>
    </div>
    
    <!-- Modal de confirmación para vaciar carrito -->
    <div class="modal fade" id="confirmClearModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">⚠️ Vaciar carrito</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">¿Estás seguro de que deseas eliminar todos los productos del carrito?</p>
                    <p class="small text-muted mb-0">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmClearBtn">Sí, vaciar carrito</button>
                </div>
            </div>
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

<script src="{{ asset('js/carrito.js') }}" defer>
</script>
@endsection