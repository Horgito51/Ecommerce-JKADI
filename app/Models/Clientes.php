<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $incrementing = false;
    protected $fillable =['id_cliente', 'cli_nombre','cli_ruc_ced', 'estado_cli', 'cli_telefono',
     'cli_direccion', 'cli_email', 'ciudad_id'];

    public function ciudades():BelongsTo{
        return $this->belongsTo(Ciudades::class, 'ciudad_id');
    }


    public static function getClientes(){
        return self::select('id_cliente', 'cli_nombre','cli_ruc_ced', 'cli_telefono','ciudad_id','cli_direccion',
         'cli_email')->where('estado_cli',"=","ACT")->get();
    }

    public static function updateClientes($id_cliente, $data){
        return self::where('id_cliente', $id_cliente)->update($data);
    }

    public static function destroyClientes($id_cliente){
        return self::where('id_cliente',$id_cliente)->update(['estado_cli'=>'INA']);
    }

    public static function createClientes($data){
        return self::create($data);
    }

}
