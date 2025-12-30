<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,   
            'proxfac',        
            'id_factura',      
            'id_producto'      
        )->withPivot([
            'pxf_cantidad',
            'pxf_precio',
            'pxf_subtotal',
            'pxf_estado'
        ])->withTimestamps();
    }



    public function clientes():BelongsTo{
        return $this->belongsTo(Clientes::class, 'id_cliente', 'id_cliente');
    }


    public static function getFacturaById(string $id){
        return self::with('productos')
                ->where('id_factura', trim($id))
                ->firstOrFail();
    }

    public static function getFacturas(){
        return self::whereIn('fac_estado', ['ABI', 'APR'])
                ->paginate(10);
    }

public static function updateFacturas(string $idFactura, array $data)
{
    return DB::transaction(function () use ($idFactura, $data) {

        $factura = self::findOrFail($idFactura);

        $factura->update([
            'id_cliente'      => $data['id_cliente'],
            'fac_descripcion' => $data['fac_descripcion'],
            'fac_subtotal'    => $data['fac_subtotal'],
            'fac_iva'         => $data['fac_iva'],
            'fac_total'       => $data['fac_total'],
            'fac_estado'      => 'ABI',
        ]);

        Proxfac::where('id_factura', $idFactura)->delete();

        foreach ($data['productos'] as $producto) {

            $subtotal = $producto['pxf_cantidad'] * $producto['pxf_precio'];

            Proxfac::create([
                'id_factura'   => $idFactura,
                'id_producto'  => $producto['id_producto'],
                'pxf_cantidad' => $producto['pxf_cantidad'],
                'pxf_precio'   => $producto['pxf_precio'],
                'pxf_subtotal' => $subtotal,
                'pxf_estado'   => 'ABI',
            ]);
        }

        return $factura;
    });
}


    public static function destroyFacturas(string $id)
    {
        return DB::transaction(function () use ($id) {
            //Primero el detalle
            Proxfac::where('id_factura', $id)
                ->update(['pxf_estado' => 'ANU']);
                
            //Luego la factura
            Factura::where('id_factura', $id)
            ->update(['fac_estado' => 'ANU']);


        });
        
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

    public static function createFactura(array $data){
        
        return DB::transaction(function () use ($data) {
            $id_fac=self::crearIdFactura();
            $factura= self::create([
                'id_factura'      => $id_fac,
                'id_cliente'      => $data['id_cliente'],
                'fac_descripcion' => $data['fac_descripcion'],
                'fac_subtotal'    => $data['fac_subtotal'],  
                'fac_iva'         => $data['fac_iva'],       
                'fac_total'       => $data['fac_total'],
                'fac_estado'      => 'APR',

            ]);

            foreach ($data['productos'] as $producto) {

            $subtotal = $producto['pxf_cantidad'] * $producto['pxf_precio'];

            Proxfac::createProxFac([
                'id_factura'    => $id_fac,
                'id_producto'  => $producto['id_producto'],
                'pxf_cantidad' => $producto['pxf_cantidad'],
                'pxf_precio'    => $producto['pxf_precio'],
                'pxf_subtotal' => $subtotal,
                'pxf_estado'  => 'APR',
            ]);
        }
            return $factura;
            
        });
        
    }

    public function scopegetFacturaBy($query,$search){
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('fac_descripcion', 'like', "%{$search}%")
                  ->orWhere('id_factura', 'like', "%{$search}%");
            });
        }
    }

    public function aprobarFactura($id){
        DB::statement('CALL aprobar_factura(?)', [$id]);
    }
}
