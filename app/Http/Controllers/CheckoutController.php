<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        $user = Auth::user();

        $cliente = Clientes::where('user_id', $user->id)->first();

        // Traer carrito activo del usuario
        $carrito = Carrito::where('user_id', $user->id)
            ->where('estado', 'activo')
            ->first();

        $items = collect();
        $subtotal = 0;

        if ($carrito) {
            // IMPORTANTE: con producto para tener nombre/imagen
            $items = $carrito->items()->with('producto')->get();

            $subtotal = $items->sum(fn($it) => (float)$it->precio_unitario * (int)$it->cantidad);
        }

        $ivaRate = 0.15;
        $iva = round($subtotal * $ivaRate, 2);
        $total = round($subtotal + $iva, 2);

        return view('ecommerce.checkout', compact(
            'user',
            'cliente',
            'items',
            'subtotal',
            'iva',
            'total',
            'ivaRate'
        ));
    }

    public function proceed(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form', [
                'redirect' => route('checkout.index')
            ]);
        }

        // Luego aquí validamos carrito != vacío y llamamos pasarela
        return back()->with('success', 'Aquí se llamará a la pasarela de pago.');
    }
}
