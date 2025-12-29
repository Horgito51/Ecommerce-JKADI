<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
class Proveedor extends Model
{
    use HasFactory;
    protected $table='proveedores';

    protected $primaryKey = 'id_proveedor';
        public $incrementing = false;
    protected $keyType = 'string';


     protected $fillable = [
        'id_proveedor',
        'prv_nombre',
        'prv_ruc_ced',
        'prv_telefono',
        'prv_mail',
        'id_ciudad',
        'prv_celular',
        'prv_direccion',
        'estado_prv',
    ];

    //relaciones
     public function ciudades():BelongsTo{
        return $this->belongsTo(Ciudades::class, 'id_ciudad');
    }
    
    public function compras()
    {
        return $this->hasMany(
            Compra::class,
            'id_proveedor',
            'id_proveedor'
        );
    }

    public static function getProveedores(){
        return self::select('id_proveedor',
        'prv_nombre',
        'prv_ruc_ced',
        'prv_telefono',
        'prv_mail',
        'id_ciudad',
        'prv_celular',
        'prv_direccion',
        'estado_prv')->where('estado_prv','=','ACT')->paginate(10);
    }

    public static function getProveedorById(string $id)
{
    return self::where('id_proveedor', $id)->firstOrFail();
}

   public static function createProveedor(array $data)
{
     $ultimo = Proveedor::orderBy('id_proveedor', 'desc')->first();
    $numero = $ultimo ? intval(substr($ultimo->id_proveedor, 3)) + 1 : 1;
    $ID= 'PRV' . str_pad($numero, 3, '0', STR_PAD_LEFT);
    return  Proveedor::create([
        'id_proveedor'   => $ID,
        'prv_nombre'     => $data['prv_nombre'],
        'prv_ruc_ced'    => $data['prv_ruc_ced'],
        'prv_telefono'   => $data['prv_telefono'],
        'prv_mail'       => $data['prv_mail'],
        'id_ciudad'      => $data['id_ciudad'],
        'prv_celular'    => $data['prv_celular'],
        'prv_direccion'  => $data['prv_direccion'],
        'estado_prv'     => 'ACT',
    ]);

}
    public static function updateProveedor($id,array $data){
        $proveedor=self::getProveedorById($id);
        if($proveedor->compras()->exists()){
            return false;
        }
        return  $proveedor->update($data);
    }

    public static function destroyProveedor(string $id){
        return Proveedor::where('id_proveedor','=',$id)->update(['estado_prv'=>'INA']);

    }
}
