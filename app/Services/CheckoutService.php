<?php

namespace App\Services;

use App\Models\Carrito;
use App\Models\Clientes;
use App\Models\Factura;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckoutService
{
    public const IVA_RATE = 0.15;

    public function resumen(Carrito $carrito): array
    {
        $items = $carrito->items()->with('producto')->get();

        $subtotal = $items->sum(fn($it) => (float)$it->precio_unitario * (int)$it->cantidad);

        $ivaRate = (float) config('properties.iva', self::IVA_RATE);
        $iva = round($subtotal * $ivaRate, 2);
        $total = round($subtotal + $iva, 2);

        return compact('items', 'subtotal', 'iva', 'total');
    }

    public function pagarSimuladoCrearFacturaYConvertir(Carrito $carrito, string $descripcion = 'Venta e-commerce (pago simulado)'): string
    {
        if ($carrito->estado !== Carrito::ESTADO_ACTIVO) {
            throw new HttpResponseException(
                response()->json(['message' => 'El carrito no está activo.'], 422)
            );
        }

        if ($carrito->expires_at && $carrito->expires_at->isPast()) {
            $carrito->update(['estado' => Carrito::ESTADO_ABANDONADO]);
            throw new HttpResponseException(
                response()->json(['message' => 'Tu carrito expiró. Vuelve a agregar los productos.'], 422)
            );
        }

        $items = $carrito->items()->with('producto')->get();
        if ($items->isEmpty()) {
            throw new HttpResponseException(
                response()->json(['message' => 'Tu carrito está vacío.'], 422)
            );
        }

        $user = Auth::user();
        $cliente = Clientes::where('user_id', $user->id)->first();
        if (!$cliente) {
            throw new HttpResponseException(
                response()->json(['message' => 'No existe un cliente asociado a este usuario. Crea el cliente primero.'], 422)
            );
        }

        foreach ($items as $it) {
            $p = $it->producto;
            $stock = (int)($p->pro_saldo_final ?? 0);
            if ($stock <= 0 || (int)$it->cantidad > $stock) {
                throw new HttpResponseException(
                    response()->json(['message' => "Stock insuficiente para {$p->pro_descripcion}."], 422)
                );
            }
        }

        $subtotal = $items->sum(fn($it) => (float)$it->precio_unitario * (int)$it->cantidad);

        $ivaRate = (float) config('properties.iva', self::IVA_RATE);
        $iva = round($subtotal * $ivaRate, 2);
        $total = round($subtotal + $iva, 2);

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

        $factura = Factura::createFactura($data);
        $idFactura = $factura->id_factura;

        Factura::aprobarFactura($idFactura);

        $carrito->markAsConvertido();

        return $idFactura;
    }
}
