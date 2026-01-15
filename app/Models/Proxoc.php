<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Proxoc extends Model
{
    use HasFactory;
   protected $table = 'proxoc';
    public $incrementing = false;
     protected $primaryKey = null;
    public $timestamps = false;

    protected $fillable = [
        'id_compra',
        'id_producto',
        'pxo_cantidad',
        'pxo_valor',
        'pxo_subtotal',
        'estado_pxoc'
    ];

    //relaciones

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra', 'id_compra');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }


        public static function getProxOc(){
        return self::select('id_compra', 'id_producto', 'pxo_cantidad', 'pxo_valor', 'pxo_subtotal', 'pxo_estado')
            ->whereIn('estado_pxoc', ['ACT', 'APR'])
            ->paginate(10);
    }

    public static function createProxOc(array $data){
        return self::create($data);
    }

    public static function updateProxOc($id_compra, $id_producto, $data){
        return self::where('id_compra', $id_compra)
            ->where('id_producto',$id_producto)
            ->update($data);
    }

    public static function destroyProxOc($id_factura, $id_producto){
        return self::where('id_factura', $id_factura)
            ->where('id_producto',$id_producto)
            ->delete();
    }

    public static function getProxOcById($id_compra, $id_producto){
        return self::where('id_compra', $id_compra)
            ->where('id_producto',$id_producto)
            ->first();
    }
}
