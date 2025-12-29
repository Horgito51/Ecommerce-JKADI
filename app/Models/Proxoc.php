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
}
