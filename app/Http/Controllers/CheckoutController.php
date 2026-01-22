<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form', [
                'redirect' => route('checkout.index')
            ]);
        }

        // ✅ Extra seguro: si aún existe cookie de carrito anónimo, la fusiona al usuario
        Carrito::mergeCookieCartToUser(Auth::id());

        $user = Auth::user();

        $cliente = Clientes::where('user_id', $user->id)->first();

        // SOLO carrito activo (no crear nuevo)
        $carrito = Carrito::where('user_id', $user->id)
            ->where('estado', Carrito::ESTADO_ACTIVO)
            ->first();

        $items = collect();
        $subtotal = 0;

        if ($carrito) {
            // Si expiró, se marca abandonado y se trata como vacío
            if ($carrito->expires_at && $carrito->expires_at->isPast()) {
                $carrito->update(['estado' => Carrito::ESTADO_ABANDONADO]);
                $carrito = null;
            } else {
                // ✅ Mantener vivo el carrito cuando el user entra a checkout
                $carrito->renew();

                $items = $carrito->items()->with('producto')->get();
                $subtotal = $items->sum(fn ($it) =>
                    (float) $it->precio_unitario * (int) $it->cantidad
                );
            }
        }

        $ivaRate = config('properties.iva');
        $iva = round($subtotal * $ivaRate, 2);
        $total = round($subtotal + $iva, 2);

        return view('Ecommerce.checkout', compact(
            'user',
            'cliente',
            'items',
            'subtotal',
            'iva',
            'total',
            'ivaRate'
        ));
    }

    public function proceed(Request $request, \App\Services\CheckoutService $checkout)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form', ['redirect' => route('checkout.index')]);
        }

        // ✅ Extra seguro aquí también
        Carrito::mergeCookieCartToUser(Auth::id());

        // Validación mínima server-side (simulación)
        $request->validate([
            'card_name'   => ['required','string','min:3','max:80'],
            'card_number' => ['required','string'],
            'card_exp'    => ['required','string'],
            'card_cvv'    => ['required','string'],
        ]);

        $user = Auth::user();

        $carrito = Carrito::where('user_id', $user->id)
            ->where('estado', Carrito::ESTADO_ACTIVO)
            ->first();

        if (!$carrito) {
            return redirect()->route('carrito.index')->with('error', 'No tienes un carrito activo.');
        }

        // ✅ renovar antes de pagar (opcional pero consistente)
        $carrito->renew();

        $idFactura = $checkout->pagarSimuladoCrearFacturaYConvertir(
            $carrito,
            'Venta e-commerce (pago simulado)'
        );

        return redirect()->route('portada.index')
            ->with('success', "Pago simulado exitoso ✅ | Factura generada y aprobada: {$idFactura}");
    }
}
