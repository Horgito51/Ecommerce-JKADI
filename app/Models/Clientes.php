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
        $cliente=self::getClienteById($id_cliente);

        if ($cliente->facturas()->exists()) {
            // El cliente tiene facturas asociadas, no se puede eliminar
            return false;
        }

        return $cliente->update(['estado_cli' => 'INA']);
    }

    public static function crearIdCliente(){
        $ultimoCliente=self::orderBy('id_cliente', 'desc')->first();

        if(!$ultimoCliente){
            return 'CLI001';

        }
        $numero = intval(substr($ultimoCliente->id_cliente, 3));

        // Incrementar
        $nuevoNumero = $numero + 1;

        // Formatear con ceros
        return 'CLI' . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);
    }

    public static function createClientes($data){
        return self::create($data);
    }

    public static function getClienteById($id_cliente){
        return self::where('id_cliente', trim($id_cliente))->first();
    }

}
