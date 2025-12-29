<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proxfac extends Model
{
    use HasFactory;
    protected $table = 'proxfac';
    protected $primaryKey = ['id_factura', 'id_producto'];
    public $incrementing = false;
    protected $fillable = [
        'id_factura',
        'id_producto',
        'pxf_cantidad',
        'pxf_precio',
        'pxf_subtotal',
        'pxf_estado',
    ];

    public function facturas():BelongsTo{
        return $this->belongsTo(Factura::class, 'id_factura');
    }

    public function productos():BelongsTo{
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public static function getProxFac(){
        return self::select('id_factura', 'id_producto', 'pxf_cantidad', 'pxf_precio', 'pxf_subtotal', 'pxf_estado')
            ->whereIn('fac_estado', ['ABI', 'APR'])
            ->paginate(10);
    }

    public static function createProxFac(array $data){
        return self::create($data);
    }

    public static function updateProxFac($id_factura, $id_producto, $data){
        return self::where('id_factura', $id_factura)
            ->where('id_producto',$id_producto)
            ->update($data);
    }

    public static function destroyProxFac($id_factura, $id_producto){
        return self::where('id_factura', $id_factura)
            ->where('id_producto',$id_producto)
            ->delete();
    }

    public static function getProxFacById($id_factura, $id_producto){
        return self::where('id_factura', $id_factura)
            ->where('id_producto',$id_producto)
            ->first();
    }
}
