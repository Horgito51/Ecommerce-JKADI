<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        return view('Ecommerce.carrito');
    }

    // GET /carrito/data
    public function show()
    {
        $carrito = Carrito::getOrCreateForCurrentUserOrCookie();
        return response()->json($carrito->toSidebarPayload());
    }

    // POST /carrito/add
    public function add(Request $request)
    {
        $request->validate([
            'id_producto' => ['required', 'string', 'max:15'],
            'cantidad'    => ['nullable', 'integer', 'min:1'],
        ]);

        $carrito = Carrito::getOrCreateForCurrentUserOrCookie();
        $cantidad = (int) ($request->cantidad ?? 1);

        $carrito->addProducto($request->id_producto, $cantidad);

        return response()->json($carrito->toSidebarPayload());
    }

    // PATCH /carrito/update
    public function update(Request $request)
    {
        $request->validate([
            'id_producto' => ['required', 'string', 'max:15'],
            'cantidad'    => ['required', 'integer', 'min:0'],
        ]);

        $carrito = Carrito::getOrCreateForCurrentUserOrCookie();
        $carrito->updateCantidad($request->id_producto, (int) $request->cantidad);

        return response()->json($carrito->toSidebarPayload());
    }

    // DELETE /carrito/remove/{id_producto}
    public function remove(string $id_producto)
    {
        $carrito = Carrito::getOrCreateForCurrentUserOrCookie();
        $carrito->removeProducto($id_producto);

        return response()->json($carrito->toSidebarPayload());
    }

    // DELETE /carrito/clear
    public function clear()
    {
        $carrito = Carrito::getOrCreateForCurrentUserOrCookie();
        $carrito->clearItems();

        return response()->json($carrito->toSidebarPayload());
    }
}
