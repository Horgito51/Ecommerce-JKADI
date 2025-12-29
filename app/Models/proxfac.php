<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class proxfac extends Model
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
}
