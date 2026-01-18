<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CarritoController extends Controller
{
    public function index()
    {
        return view('ecommerce.carrito'); 
    }
    // Tiempo de vida del carrito
    private int $ttlDays = 15;

    /**
     * Obtener o crear carrito (con usuario o sin)
     */
    private function getOrCreateCarrito(): Carrito
    {
        //Usuario logueado: carrito por user_id
        if (Auth::check()) {
            $carrito = Carrito::where('user_id', Auth::id())
                ->where('estado', 'activo')
                ->first();

            if (!$carrito) {
                $carrito = Carrito::create([
                    'user_id' => Auth::id(),
                    'token' => (string) Str::uuid(),
                    'estado' => 'activo',
                    'expires_at' => now()->addDays($this->ttlDays),
                ]);
            } else {
                // renovar expiracion
                $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);
            }

            return $carrito;
        }

        //Usuario anonimo: carrito por cookie
        $token = request()->cookie('cart_token');

        if ($token) {
            $carrito = Carrito::where('token', $token)
                ->where('estado', 'activo')
                ->first();

            if ($carrito) {
                // renovar expiracion
                $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);
                return $carrito;
            }
        }

        //Crear carrito anonimo + setear cookie
        $carrito = Carrito::create([
            'token' => (string) Str::uuid(),
            'estado' => 'activo',
            'expires_at' => now()->addDays($this->ttlDays),
        ]);

        cookie()->queue('cart_token', $carrito->token, 60 * 24 * $this->ttlDays);

        return $carrito;
    }

    /**
     * Respuesta por defecto para el sidebar
     */
    private function cartResponse(Carrito $carrito)
    {
        $items = $carrito->items()->with('producto')->get();

        $subtotal = $items->sum(fn ($item) =>
            $item->cantidad * $item->precio_unitario
        );

        return response()->json([
            'carrito_id' => $carrito->id,
            'token' => $carrito->token,
            'items' => $items,
            'count' => (int) $items->sum('cantidad'),
            'subtotal' => (float) $subtotal,
            'expires_at' => optional($carrito->expires_at)->toDateTimeString(),
        ]);
    }

    /**
     * Obtener stock disponible del producto
     */
    private function stockDisponible(Producto $producto): int
    {
        return (int) ($producto->pro_saldo_final ?? 0);
    }

    //

    // GET
    public function show()
    {
        $carrito = $this->getOrCreateCarrito();
        return $this->cartResponse($carrito);
    }

    // POST
    public function add(Request $request)
    {
        $request->validate([
            'id_producto' => ['required', 'string', 'max:15'],
            'cantidad' => ['nullable', 'integer', 'min:1'],
        ]);

        $cantidadAgregar = (int) ($request->cantidad ?? 1);

        $producto = Producto::where('id_producto', $request->id_producto)->firstOrFail();
        $stock = $this->stockDisponible($producto);

        if ($stock <= 0) {
            return response()->json(['message' => 'Producto sin stock.'], 422);
        }

        $carrito = $this->getOrCreateCarrito();

        $item = CarritoItem::where('carrito_id', $carrito->id)
            ->where('id_producto', $producto->id_producto)
            ->first();

        if (!$item) {
            $item = CarritoItem::create([
                'carrito_id' => $carrito->id,
                'id_producto' => $producto->id_producto,
                'cantidad' => 0,
                'precio_unitario' => $producto->pro_precio_venta, // snapshot
            ]);
        }

        $nuevaCantidad = $item->cantidad + $cantidadAgregar;

        //maximo stock para seleccionar 
        if ($nuevaCantidad > $stock) {
            return response()->json([
                'message' => "Stock insuficiente. Disponible: {$stock}",
                'stock' => $stock
            ], 422);
        }

        $item->cantidad = $nuevaCantidad;
        $item->save();

        // Renovar expiracion del carrito
        $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);

        return $this->cartResponse($carrito);
    }

    // PATCH /carrito/update  { id_producto, cantidad }
    // - cantidad = 0 => elimina
    // - cantidad >= 1 y <= stock
    public function update(Request $request)
    {
        $request->validate([
            'id_producto' => ['required', 'string', 'max:15'],
            'cantidad' => ['required', 'integer', 'min:0'],
        ]);

        $carrito = $this->getOrCreateCarrito();

        $item = CarritoItem::where('carrito_id', $carrito->id)
            ->where('id_producto', $request->id_producto)
            ->firstOrFail();

        $cantidad = (int) $request->cantidad;

        // 0 => eliminar
        if ($cantidad === 0) {
            $item->delete();
            $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);
            return $this->cartResponse($carrito);
        }

        // Validar stock
        $producto = Producto::where('id_producto', $request->id_producto)->firstOrFail();
        $stock = $this->stockDisponible($producto);

        if ($stock <= 0) {
            //Si el stock esta en 0, se elimina del carro y se muestra un mensaje
            $item->delete();
            $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);
            return response()->json([
                'message' => 'Producto sin stock, se removio del carrito.',
            ], 422);
        }

        if ($cantidad > $stock) {
            return response()->json([
                'message' => "Stock insuficiente. Disponible: {$stock}",
                'stock' => $stock
            ], 422);
        }

        // Minimo 1
        $item->cantidad = $cantidad;
        $item->save();

        $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);

        return $this->cartResponse($carrito);
    }

    // DELETE
    public function remove(string $id_producto)
    {
        $carrito = $this->getOrCreateCarrito();

        CarritoItem::where('carrito_id', $carrito->id)
            ->where('id_producto', $id_producto)
            ->delete();

        $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);

        return $this->cartResponse($carrito);
    }

    // DELETE
    public function clear()
    {
        $carrito = $this->getOrCreateCarrito();

        $carrito->items()->delete();

        $carrito->update(['expires_at' => now()->addDays($this->ttlDays)]);

        return $this->cartResponse($carrito);
    }
}
