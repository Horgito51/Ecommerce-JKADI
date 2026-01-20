<?php

namespace App\Services;

use App\Models\Carrito;
use App\Models\Clientes;
use App\Models\Factura;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    public const IVA_RATE = 0.15;

    /**
     * Calcula items + totales desde el carrito (fuente de verdad server).
     */
    public function resumen(Carrito $carrito): array
    {
        $items = $carrito->items()->with('producto')->get();

        $subtotal = $items->sum(fn($it) => (float)$it->precio_unitario * (int)$it->cantidad);
        $iva = round($subtotal * self::IVA_RATE, 2);
        $total = round($subtotal + $iva, 2);

        return compact('items', 'subtotal', 'iva', 'total');
    }

    /**
     * Flujo final:
     * - valida carrito (activo, no expirado, con items)
     * - obtiene cliente del user
     * - crea factura + detalle usando Factura::createFactura (tu método)
     * - llama SP aprobar_factura (tu método)
     * - convierte carrito
     *
     * Retorna el id_factura generado.
     */
    public function pagarSimuladoCrearFacturaYConvertir(Carrito $carrito, string $descripcion = 'Venta e-commerce (pago simulado)'): string
    {
        // 1) validar carrito
        if ($carrito->estado !== Carrito::ESTADO_ACTIVO) {
            abort(422, 'El carrito no está activo.');
        }

        if ($carrito->expires_at && $carrito->expires_at->isPast()) {
            $carrito->update(['estado' => Carrito::ESTADO_ABANDONADO]);
            abort(422, 'Tu carrito expiró. Vuelve a agregar los productos.');
        }

        $items = $carrito->items()->with('producto')->get();
        if ($items->isEmpty()) {
            abort(422, 'Tu carrito está vacío.');
        }

        // 2) cliente del usuario
        $user = Auth::user();
        $cliente = Clientes::where('user_id', $user->id)->first();
        if (!$cliente) {
            abort(422, 'No existe un cliente asociado a este usuario. Crea el cliente primero.');
        }

        // 3) validar stock REAL antes de facturar/aprobar (simple)
        foreach ($items as $it) {
            $p = $it->producto;
            $stock = (int)($p->pro_saldo_final ?? 0);
            if ($stock <= 0 || (int)$it->cantidad > $stock) {
                abort(422, "Stock insuficiente para {$p->pro_descripcion}.");
            }
        }

        // 4) totales server-side
        $subtotal = $items->sum(fn($it) => (float)$it->precio_unitario * (int)$it->cantidad);
        $iva = round($subtotal * self::IVA_RATE, 2);
        $total = round($subtotal + $iva, 2);

        // 5) armar data como tu createFactura espera
        $data = [
            'id_cliente'      => $cliente->id_cliente,
            'fac_descripcion' => $descripcion,
            'fac_subtotal'    => $subtotal,
            'fac_iva'         => $iva,
            'fac_total'       => $total,
            'productos'       => $items->map(function ($it) {
                return [
                    'id_producto'  => $it->id_producto,
                    'pxf_cantidad' => (int)$it->cantidad,
                    'pxf_precio'   => (float)$it->precio_unitario,
                ];
            })->values()->all(),
        ];

        // 6) crear factura + detalle (ya viene en DB::transaction en tu modelo)
        $factura = Factura::createFactura($data);
        $idFactura = $factura->id_factura;

        // 7) aprobar con SP (NO envolver en DB::transaction aquí por el ROLLBACK del SP)
        Factura::aprobarFactura($idFactura);

        // 8) convertir carrito (solo si todo fue OK)
        $carrito->markAsConvertido();

        return $idFactura;
    }
}
