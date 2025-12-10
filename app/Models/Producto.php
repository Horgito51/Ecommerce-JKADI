<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    protected $fillable = [
        'id_producto',
        'id_tipo',
        'pro_descripcion',
        'pro_um_venta',
        'pro_um_compra', 
        'estado_prod',
        'pro_saldo_inicial'
    ];

    public static function getAllProductos()
    {
        return self::select('id_producto','pro_descripcion','pro_um_compra','pro_um_venta','pro_saldo_final')->where('pro_saldo_final','>',0)->where('estado_prod',"=","ACT")->limit(10)->get(); 
    }
}
