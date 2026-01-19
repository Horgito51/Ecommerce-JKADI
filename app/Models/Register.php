<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DomainException;

class Register extends Model
{
    /**
     * Si NO tienes tabla 'registers', puedes dejarlo así.
     * Este model se usa como "proceso" (lógica de registro).
     * No necesitas $table ni $fillable aquí porque no vas a hacer Register::create().
     */

    /**
     * Registra (o vincula) un Cliente con un User y devuelve el User final.
     *
     * Reglas:
     * - Si existe cliente y ya tiene user_id => error
     * - Si existe cliente sin user_id => crear user (si no existe) y asociar
     * - Si no existe cliente => crear user (si no existe) + crear cliente asociado
     */
    public static function registrarCliente(array $data)
    {
        $email = trim(mb_strtolower($data['cli_email']));
        $doc   = trim($data['cli_ruc_ced']);

        return DB::transaction(function () use ($data, $email, $doc) {

            // 1) Buscar cliente por documento o email
            $cliente = Clientes::where('cli_ruc_ced', $doc)
                ->orWhere('cli_email', $email)
                ->first();

            // 2) Buscar user por email
            $user = User::where('email', $email)->first();

            // 3) Si cliente existe y ya tiene cuenta asociada => bloquear
            if ($cliente && !is_null($cliente->user_id)) {
                throw new DomainException('Este cliente ya tiene una cuenta registrada. Inicie sesión.');
            }

            // 4) Si no existe user => crear
            if (!$user) {
                $user = User::create([
                    'name'     => $data['cli_nombre'],
                    'email'    => $email,
                    'password' => Hash::make($data['password']),
                    'rol'      => 'cliente',
                ]);
            }

            // 5) Asociar / Crear cliente
            if ($cliente) {
                // Cliente existe pero sin user_id
                $cliente->user_id   = $user->id;
                $cliente->cli_email = $email; // asegurar email normalizado
                $cliente->save();
            } else {
                // Cliente NO existe => crear y asociar
                Clientes::createClientes([
                    'cli_nombre'    => $data['cli_nombre'],
                    'cli_ruc_ced'   => $doc,
                    'cli_telefono'  => $data['cli_telefono'],
                    'ciudad_id'     => $data['ciudad_id'],
                    'cli_direccion' => $data['cli_direccion'],
                    'cli_email'     => $email,
                    'estado_cli'    => 'ACT',
                    'user_id'       => $user->id,
                ]);
            }

            return $user;
        });
    }
}
