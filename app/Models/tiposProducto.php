<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tiposProducto extends Model
{
    protected $table = 'tipos_producto';
    protected $primaryKey = 'id_tipo';
    public $timestamps = false;
        public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_tipo',
        'tipo_descripcion'
    ];

    
    public static function getAllTiposProducto(){
        return self::select('id_tipo','tipo_descripcion')->get();
    }   

}