<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    //MD concepto

    public static function getCompras(){
        return Compra::where('estado_oc','=','ACT')->paginate(10);
    }

    public static function getComprasById(string $id){
        return Compra::findorfail($id);
    }

    public static function getComprasBy(string $search){
    }

}
