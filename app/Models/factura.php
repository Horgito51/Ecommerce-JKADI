<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class factura extends Model
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


    public function clientes():BelongsTo{
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
}
