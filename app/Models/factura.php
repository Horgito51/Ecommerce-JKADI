<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    public $incrementing = false;
    protected $fillable = [
        'id_factura',
        'id_cliente',
        'fac_descripcion',
        'fac_subtotal',
        'fac_iva',
        'fac_total',
        'fac_estado',
    ];
    protected $keyType = 'string';


    public function clientes():BelongsTo{
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }

    public static function getFacturas(){
        return self::whereIn('fac_estado', ['ABI', 'APR'])
                ->paginate(10);
    }

    public static function updateFacturas(string $id, array $data){
    $factura = self::findOrFail($id);

        $factura->update([
            'id_cliente' => $data['id_cliente'],
            'fac_descripcion' => $data['fac_descripcion'],
            'fac_subtotal' => $data['fac_subtotal'],
            'fac_iva' => $data['fac_iva'],
            'fac_total' => $data['fac_total'],
        ]);
    }


    public static function destroyFacturas(string $id)
    {
        $factura = self::findOrFail($id);
        $factura->fac_estado = 'ANU';
        $factura->save();
    }


    public static function crearIdFactura()
    {
        $ultimaFactura = self::orderBy('id_factura', 'desc')->first();

        if (!$ultimaFactura) {
            return 'FAC001';
        }

        $numero = intval(substr($ultimaFactura->id_factura, 3));
        $nuevoNumero = $numero + 1;

        return 'FAC' . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);
    }

    public static function createFactura(array $data)
    {
        return self::create([
            'id_factura'      => self::crearIdFactura(),
            'id_cliente'      => $data['id_cliente'],
            'fac_descripcion' => $data['fac_descripcion'] ?? null,
            'fac_subtotal'    => $data['fac_subtotal'],  
            'fac_iva'         => $data['fac_iva'],       
            'fac_total'       => $data['fac_total'],
            'fac_estado'      => 'ABI',
        ]);
    }

    public function scopegetFacturaBy($query,$search){
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('fac_descripcion', 'like', "%{$search}%")
                  ->orWhere('id_factura', 'like', "%{$search}%");
            });
        }
    }
}
