// public/js/carrito.js

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const state = { items: [], subtotal: 0, count: 0 };

const money = (v) => '$' + Number(v || 0).toFixed(2);

// Sistema de alertas mejorado
function showAlert(msg, type = 'warning') {
    const container = document.getElementById('alertContainer');
    
    // Limpiar alertas anteriores
    container.innerHTML = '';
    
    // Determinar el color según el tipo
    let bgColor, textColor;
    switch(type) {
        case 'success':
            bgColor = '#d4edda';
            textColor = '#155724';
            break;
        case 'danger':
            bgColor = '#f8d7da';
            textColor = '#721c24';
            break;
        case 'warning':
        default:
            bgColor = '#fff3cd';
            textColor = '#856404';
            break;
    }
    
    // Crear alerta
    const alert = document.createElement('div');
    alert.style.cssText = `
        background-color: ${bgColor};
        color: ${textColor};
        padding: 15px 20px;
        border-radius: 4px;
        margin-bottom: 15px;
        font-size: 15px;
        animation: slideDown 0.3s ease-out;
    `;
    alert.textContent = msg;
    
    container.appendChild(alert);
    
    // Auto-ocultar después de 3 segundos
    setTimeout(() => {
        alert.style.animation = 'slideUp 0.3s ease-out';
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 300);
    }, 3000);
}

// Agregar animaciones CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
`;
document.head.appendChild(style);

async function api(url, { method='GET', body=null } = {}) {
    const headers = {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrf,
    };
    if (body) headers['Content-Type'] = 'application/json';

    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 15000); // Timeout de 15s

    try {
        const res = await fetch(url, {
            method,
            headers,
            body: body ? JSON.stringify(body) : null,
            credentials: 'same-origin',
            signal: controller.signal,
        });

        clearTimeout(timeoutId);
        const data = await res.json().catch(() => ({}));

        if (!res.ok) {
            const errorMessage = mapErrorMessage(res.status, data);
            if (errorMessage) showAlert(errorMessage, 'danger');
            throw data;
        }

        return data;
    } catch (error) {
        clearTimeout(timeoutId);
        if (error.name === 'AbortError') {
            showAlert('Tiempo de conexión agotado. Intenta nuevamente.', 'danger');
            throw new Error('Timeout');
        }
        throw error;
    }
}

// Mapear errores HTTP a mensajes legibles
function mapErrorMessage(statusCode, errorData) {
    const message = errorData?.message || '';
    
    switch (statusCode) {
        case 400:
            return `Solicitud inválida: ${message || 'Datos incorrectos'}`;
        case 401:
            return 'Debes iniciar sesión para continuar';
        case 403:
            return 'No tienes permiso para esta acción';
        case 404:
            return 'Producto no encontrado';
        case 422:
            return `${message || 'Error de validación'}`;
        case 500:
            return 'Error del servidor. Intenta más tarde.';
        case 503:
            return 'Servidor no disponible. Intenta en unos minutos.';
        default:
            return message || `Error ${statusCode}: Intenta nuevamente`;
    }
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
        const stock = Number(p.pro_saldo_final ?? 0);

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
                    <button class="jk-btn jk-btn-sm"
                    onclick="changeQty('${it.id_producto}', ${Number(it.cantidad) - 1}, ${stock})">-</button>

                    <input
                    class="jk-input qty-input"
                    type="number"
                    min="1"
                    max="${stock}"
                    step="1"
                    value="${it.cantidad}"
                    data-stock="${stock}"
                    onkeydown="if(event.key==='Enter'){ changeQty('${it.id_producto}', this.value, this.dataset.stock) }"
                    onblur="validateQtyAndFix('${it.id_producto}', this)"
                    >

                    <button class="jk-btn jk-btn-sm"
                    onclick="changeQty('${it.id_producto}', ${Number(it.cantidad) + 1}, ${stock})">+</button>
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

function validateQtyAndFix(id_producto, inputEl) {
    let qty = parseInt(inputEl.value, 10);
    const stock = parseInt(inputEl.dataset.stock, 10);
    let hasError = false;

    if (Number.isNaN(qty) || qty < 1) {
        showAlert('La cantidad debe ser mayor o igual a 1.', 'warning');
        qty = 1;
        hasError = true;
    }

    if (!Number.isNaN(stock) && stock > 0 && qty > stock) {
        showAlert(`Stock insuficiente. Disponible: ${stock}`, 'warning');
        qty = stock;
        hasError = true;
    }

    inputEl.value = qty;
    // Solo mostrar éxito si no hubo errores
    changeQty(id_producto, qty, !hasError);
}

async function changeQty(id_producto, cantidad, showSuccess = false) {
    let qty = parseInt(cantidad, 10);

    if (Number.isNaN(qty) || qty < 1) {
        showAlert('La cantidad debe ser mayor o igual a 1.', 'warning');
        qty = 1;
    }

    if (qty > 9999) {
        showAlert('Cantidad demasiado alta.', 'warning');
        qty = 9999;
    }

    try {
        const data = await api('/carrito/update', {
            method: 'PATCH',
            body: { id_producto, cantidad: qty }
        });
        applyData(data);
    } catch (e) {
        // api() ya muestra la alerta de error
    }
}

async function removeItem(id_producto) {
    try {
        const data = await api(`/carrito/remove/${id_producto}`, { method: 'DELETE' });
        applyData(data);
        showAlert('Producto eliminado del carrito.', 'success');
    } catch (e) {
        // api() ya muestra la alerta de error
    }
}

async function clearCart() {
    if (!state.items.length) {
        showAlert('El carrito ya está vacío.', 'warning');
        return;
    }
    
    try {
        const data = await api('/carrito/clear', { method: 'DELETE' });
        applyData(data);
        showAlert('Carrito vaciado correctamente.', 'success');
    } catch (e) {
        // api() ya muestra la alerta de error
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Botón confirmar vaciar carrito (modal)
    document.getElementById('confirmClearBtn')?.addEventListener('click', clearCart);

    document.getElementById('btnCheckout').addEventListener('click', (e) => {
        if (!state.items.length) {
            e.preventDefault();
            showAlert('Tu carrito está vacío.', 'warning');
        }
    });

    // Cargar carrito con timeout visible
    const loadCartWithFeedback = async () => {
        try {
            await loadCart();
        } catch (error) {
            // Mostrar estado de error si persiste
            const tbody = document.getElementById('tbody');
            if (tbody && tbody.innerHTML.includes('Cargando...')) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-danger">Error al cargar el carrito. <a href="javascript:location.reload()">Recargar</a></td></tr>`;
            }
        }
    };

    loadCartWithFeedback();
});