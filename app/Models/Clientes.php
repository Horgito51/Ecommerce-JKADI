<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function facturas():HasMany{
        return $this->hasMany(Factura::class, 'id_cliente');
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

        $nuevoNumero = $numero + 1;

        return 'CLI' . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);
    }

    public static function createClientes(array $data){
        
        return self::create([
            'id_cliente'   => self::crearIdCliente(),
            'cli_nombre'   => $data['cli_nombre'],
            'cli_ruc_ced'  => $data['cli_ruc_ced'],
            'cli_telefono' => $data['cli_telefono'],
            'ciudad_id'    => $data['ciudad_id'],
            'cli_direccion'=> $data['cli_direccion'],
            'cli_email'    => $data['cli_email'],
            'estado_cli'   => $data['estado_cli'],
        ]);
    }

    public static function getClienteById($id_cliente){
        return self::where('id_cliente', trim($id_cliente))->first();
    }

    public function scopeGetClienteBy($query,$search){
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('cli_nombre', 'like', "%{$search}%")
                  ->orWhere('cli_ruc_ced', 'like', "%{$search}%")
                  ->orWhere('id_cliente', 'like', "%{$search}%");
            });
        }
    }

}
