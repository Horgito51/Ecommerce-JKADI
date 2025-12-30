<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Compra extends Model
{
    protected $table = 'compras';

    protected $primaryKey = 'id_compra';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'id_compra',
        'id_proveedor',
        'oc_subtotal',
        'oc_iva',
        'oc_total',
        'estado_oc',
    ];
    //relaciones
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'proxoc',
            'id_compra',
            'id_producto'
        )->withPivot([
            'pxo_cantidad',
            'pxo_valor',
            'pxo_subtotal',
            'estado_pxoc'
        ]);
    }
    public function proveedor()
    {
        return $this->belongsTo(
            Proveedor::class,
            'id_proveedor',
            'id_proveedor'
        );
    }
    //MD concepto

    public static function getCompras()
    {
        return Compra::where('estado_oc', '!=', 'ANU')->paginate(10);
    }

    public static function getComprasById(string $id)
    {
        return Compra::findorfail($id);
    }



    public static function getComprasBy(string $search) {}


    public static function createCompra(array $data)
    {
        return DB::transaction(function () use ($data) {
            $ultimo = self::orderBy('id_compra', 'desc')->first();
            $numero = $ultimo
                ? intval(substr($ultimo->id_compra, 1)) + 1
                : 1;
            $idCompra = 'C' . str_pad($numero, 4, '0', STR_PAD_LEFT);

            //cabecera
            $compra = self::create([
                'id_compra'    => $idCompra,
                'id_proveedor' => $data['id_proveedor'],
                'oc_subtotal'  => $data['oc_subtotal'],
                'oc_iva'       => $data['oc_iva'],
                'oc_total'     => $data['oc_total'],
                'estado_oc'    => 'ACT',
            ]);
            //detalle
            foreach ($data['productos'] as $producto) {
                $subtotal = $producto['pxo_cantidad'] * $producto['pxo_valor'];
                Proxoc::create([
                    'id_compra'    => $idCompra,
                    'id_producto'  => $producto['id_producto'],
                    'pxo_cantidad' => $producto['pxo_cantidad'],
                    'pxo_valor'    => $producto['pxo_valor'],
                    'pxo_subtotal' => $subtotal,
                    'estado_pxoc'  => 'ACT',
                ]);
            }

            return $compra;
        });
    }

    public static function updateCompra(string $idCompra, array $data)
    {
        return DB::transaction(function () use ($idCompra, $data) {
            $compra = self::findOrFail($idCompra);

            $compra->update([
                'id_proveedor' => $data['id_proveedor'],
                'oc_subtotal'  => $data['oc_subtotal'],
                'oc_iva'       => $data['oc_iva'],
                'oc_total'     => $data['oc_total'],
                'estado_oc'    => 'ACT',
            ]);

            Proxoc::where('id_compra', $idCompra)->delete();
            foreach ($data['productos'] as $producto) {
                $subtotal = $producto['pxo_cantidad'] * $producto['pxo_valor'];
                Proxoc::create([
                    'id_compra'    => $idCompra,
                    'id_producto'  => $producto['id_producto'],
                    'pxo_cantidad' => $producto['pxo_cantidad'],
                    'pxo_valor'    => $producto['pxo_valor'],
                    'pxo_subtotal' => $subtotal,
                    'estado_pxoc'  => 'ACT',
                ]);
            }

            return $compra;
        });
    }
    public static function destroyCompra(string $idCompra): void
    {
        DB::transaction(function () use ($idCompra) {
            Proxoc::where('id_compra', $idCompra)
                ->update([
                    'estado_pxoc' => 'ANU',
                ]);
            $compra = self::findOrFail($idCompra);
            $compra->update([
                'estado_oc' => 'ANU',
            ]);
        });
    }

    public static function approveCompra(string $idCompra): void
    {
     DB::statement('CALL aprobar_compra(?)', [$idCompra]);
    }
}
