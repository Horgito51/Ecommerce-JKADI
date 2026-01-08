<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unidadesMedidas extends Model
{
   protected $table = 'unidades_medidas';
   protected $primaryKey = 'id_unidad_medida';
   public $timestamps = false;
   public $incrementing = false;
   protected $keyType = 'string';
   protected $fillable = [
       'id_unidad_medida',
       'um_descripcion'
   ];


   public function productosVenta(){
    return $this->hasMany(Producto::class, 'pro_um_venta', 'id_unidad_medida');

   }

   public function productosCompra(){
    return $this->hasMany(Producto::class, 'pro_um_compra', 'id_unidad_medida');

   }
   public static function getAllUnidades(){

    return self::select('id_unidad_medida','um_descripcion')->get();
   }

}
