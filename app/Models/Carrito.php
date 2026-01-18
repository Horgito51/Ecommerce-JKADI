<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';

    protected $fillable = [
        'user_id',
        'token',
        'estado',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(CarritoItem::class, 'carrito_id');
    }
}
