<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
class Carrito extends Model
{
    protected $table = 'carritos';

    protected $fillable = [
        'user_id',
        'token',
        'estado',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // Estados permitidos
    public const ESTADO_ACTIVO     = 'activo';
    public const ESTADO_ABANDONADO = 'abandonado';
    public const ESTADO_CONVERTIDO = 'convertido';

    // Config (para pruebas: 1 dia)
    private const TTL_DAYS = 1;
    private const COOKIE_NAME = 'cart_token';

    // Relaciones
    public function items()
    {
        return $this->hasMany(CarritoItem::class, 'carrito_id')
            ->orderBy('id_producto', 'asc');
    }

    // Helpers
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function renew(): void
    {
        $this->update(['expires_at' => now()->addDays(self::TTL_DAYS)]);
    }

    /**
     * Obtiene o crea carrito ACTIVO (usuario o anonimo).
     * Si el ACTIVO esta expirado -> pasa a ABANDONADO y crea uno nuevo ACTIVO.
     * Convertido NO se toca, porque aqui solo consultamos ACTIVO.
     */
    public static function getOrCreateForCurrentUserOrCookie(): self
    {
        // -----------------------
        // Usuario logueado
        // -----------------------
        if (Auth::check()) {
            $carrito = self::where('user_id', Auth::id())
                ->where('estado', self::ESTADO_ACTIVO)
                ->first();

            // Si existe un ACTIVO
            if ($carrito) {
                if ($carrito->isExpired()) {
                    // Expiró -> abandonado y crear nuevo
                    $carrito->update(['estado' => self::ESTADO_ABANDONADO]);

                    return self::create([
                        'user_id'    => Auth::id(),
                        'token'      => (string) Str::uuid(),
                        'estado'     => self::ESTADO_ACTIVO,
                        'expires_at' => now()->addDays(self::TTL_DAYS),
                    ]);
                }

                // No expiró -> renovar
                $carrito->renew();
                return $carrito;
            }

            // No existe ACTIVO -> crear
            return self::create([
                'user_id'    => Auth::id(),
                'token'      => (string) Str::uuid(),
                'estado'     => self::ESTADO_ACTIVO,
                'expires_at' => now()->addDays(self::TTL_DAYS),
            ]);
        }

        // -----------------------
        // Usuario anonimo (cookie)
        // -----------------------
        $token = request()->cookie(self::COOKIE_NAME);

        if ($token) {
            $carrito = self::where('token', $token)
                ->where('estado', self::ESTADO_ACTIVO)
                ->first();

            if ($carrito) {
                if ($carrito->isExpired()) {
                    // Expiró -> abandonado y crear nuevo + actualizar cookie
                    $carrito->update(['estado' => self::ESTADO_ABANDONADO]);

                    $nuevo = self::create([
                        'token'      => (string) Str::uuid(),
                        'estado'     => self::ESTADO_ACTIVO,
                        'expires_at' => now()->addDays(self::TTL_DAYS),
                    ]);

                    cookie()->queue(self::COOKIE_NAME, $nuevo->token, 60 * 24 * self::TTL_DAYS);
                    return $nuevo;
                }

                $carrito->renew();
                return $carrito;
            }
        }

        // No hay cookie o no hay ACTIVO -> crear nuevo + cookie
        $nuevo = self::create([
            'token'      => (string) Str::uuid(),
            'estado'     => self::ESTADO_ACTIVO,
            'expires_at' => now()->addDays(self::TTL_DAYS),
        ]);

        cookie()->queue(self::COOKIE_NAME, $nuevo->token, 60 * 24 * self::TTL_DAYS);

        return $nuevo;
    }

    /**
     * Payload de respuesta (sidebar / tabla)
     */
    public function toSidebarPayload(): array
    {
        $items = $this->items()->with('producto')->get();

        $subtotal = $items->sum(fn ($item) => $item->cantidad * $item->precio_unitario);
        $count    = (int) $items->sum('cantidad');

        return [
            'carrito_id' => $this->id,
            'token'      => $this->token,
            'items'      => $items,
            'count'      => $count,
            'subtotal'   => (float) $subtotal,
            'expires_at' => optional($this->expires_at)->toDateTimeString(),
        ];
    }

    // -----------------------
    // Operaciones del carrito
    // -----------------------
    public function addProducto(string $id_producto, int $cantidadAgregar = 1): void
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $stock = (int) ($producto->pro_saldo_final ?? 0);

        if ($stock <= 0) {
            throw new HttpResponseException(
                response()->json(['message' => 'Producto sin stock.'], 422)
            );
        }

        $item = CarritoItem::where('carrito_id', $this->id)
            ->where('id_producto', $producto->id_producto)
            ->first();

        if (!$item) {
            $item = CarritoItem::create([
                'carrito_id'      => $this->id,
                'id_producto'     => $producto->id_producto,
                'cantidad'        => 0,
                'precio_unitario' => $producto->pro_precio_venta, // snapshot
            ]);
        }

        $nuevaCantidad = $item->cantidad + $cantidadAgregar;

        if ($nuevaCantidad > $stock) {
            throw new HttpResponseException(
                response()->json(['message' => 'Stock insuficiente o las unidades están en el carrito '], 422)
            );
        }

        $item->update(['cantidad' => $nuevaCantidad]);
        $this->renew();
    }

    public function updateCantidad(string $id_producto, int $cantidad): void
    {
        $item = CarritoItem::where('carrito_id', $this->id)
            ->where('id_producto', $id_producto)
            ->firstOrFail();

        // 0 => eliminar
        if ($cantidad === 0) {
            $item->delete();
            $this->renew();
            return;
        }

        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $stock = (int) ($producto->pro_saldo_final ?? 0);

        if ($stock <= 0) {
            $item->delete();
            $this->renew();
            throw new HttpResponseException(
            response()->json(['message' => 'Producto sin stock, se removió del carrito'], 422)
            );
        }

        if ($cantidad > $stock) {
            throw new HttpResponseException(
                response()->json(['message' => 'Stock insuficiente o las unidades ya estan en el carrito.'], 422)
            );
        }

        $item->update(['cantidad' => $cantidad]);
        $this->renew();
    }

    public function removeProducto(string $id_producto): void
    {
        CarritoItem::where('carrito_id', $this->id)
            ->where('id_producto', $id_producto)
            ->delete();

        $this->renew();
    }

    public function clearItems(): void
    {
        $this->items()->delete();
        $this->renew();
    }

    /**
     * Cuando el checkout se complete:
     * - marcar como convertido
     * - (opcional) limpiar cookie anonima
     */
    public function markAsConvertido(): void
    {
        $this->update(['estado' => self::ESTADO_CONVERTIDO]);

        // Opcional: si era anonimo, romper el token para que no reapunte al convertido
        cookie()->queue(self::COOKIE_NAME, '', -1);
    }

    public static function mergeCookieCartToUser(int $userId): void
    {
        // 1) Leer token de cookie (carrito anónimo)
        $token = request()->cookie(self::COOKIE_NAME);
        if (!$token) return;

        // 2) Buscar carrito anónimo ACTIVO por token
        $guest = self::where('token', $token)
            ->whereNull('user_id')
            ->where('estado', self::ESTADO_ACTIVO)
            ->first();

        if (!$guest) {
            // Si no existe, igual limpiamos cookie para evitar basura
            cookie()->queue(self::COOKIE_NAME, '', -1);
            return;
        }

        DB::transaction(function () use ($userId, $guest) {

            // 3) Obtener carrito ACTIVO del usuario (o crearlo)
            $userCart = self::where('user_id', $userId)
                ->where('estado', self::ESTADO_ACTIVO)
                ->first();

            if ($userCart) {
                if ($userCart->isExpired()) {
                    $userCart->update(['estado' => self::ESTADO_ABANDONADO]);

                    $userCart = self::create([
                        'user_id'    => $userId,
                        'token'      => (string) Str::uuid(),
                        'estado'     => self::ESTADO_ACTIVO,
                        'expires_at' => now()->addDays(self::TTL_DAYS),
                    ]);
                } else {
                    $userCart->renew();
                }
            } else {
                $userCart = self::create([
                    'user_id'    => $userId,
                    'token'      => (string) Str::uuid(),
                    'estado'     => self::ESTADO_ACTIVO,
                    'expires_at' => now()->addDays(self::TTL_DAYS),
                ]);
            }

            // 4) Sumar items del guest al user (cap por stock)
            $guestItems = $guest->items()->get();

            foreach ($guestItems as $gItem) {
                $producto = Producto::where('id_producto', $gItem->id_producto)->first();
                if (!$producto) continue;

                $stock = (int) ($producto->pro_saldo_final ?? 0);
                if ($stock <= 0) continue;

                $existing = CarritoItem::where('carrito_id', $userCart->id)
                    ->where('id_producto', $gItem->id_producto)
                    ->first();

                $guestQty = (int) $gItem->cantidad;

                if ($existing) {
                    $newQty = min($stock, (int)$existing->cantidad + $guestQty);

                    // si ya estaba en el carrito, conservamos su precio_unitario actual del item
                    $existing->update(['cantidad' => $newQty]);
                } else {
                    $newQty = min($stock, $guestQty);

                    if ($newQty > 0) {
                        CarritoItem::create([
                            'carrito_id'      => $userCart->id,
                            'id_producto'     => $gItem->id_producto,
                            'cantidad'        => $newQty,
                            // snapshot: usa el precio del guest si existe, si no el del producto
                            'precio_unitario' => $gItem->precio_unitario ?? $producto->pro_precio_venta,
                        ]);
                    }
                }
            }

            // 5) Desactivar carrito guest y limpiar sus items
            $guest->items()->delete();
            $guest->update(['estado' => self::ESTADO_ABANDONADO]);

            // 6) Renovar carrito del user
            $userCart->renew();
        });

        // 7) Borrar cookie del carrito anónimo (ya se fusionó)
        cookie()->queue(self::COOKIE_NAME, '', -1);
    }
}
