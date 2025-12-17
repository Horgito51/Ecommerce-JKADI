<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use HasFactory;
    protected $table = 'ciudades';
    
    protected $fillable =['ciu_descripcion'];

    public function clientes(): HasMany
    {
        return $this->hasMany(Clientes::class);
    }

}
