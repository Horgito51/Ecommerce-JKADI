<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DomainException;

class Register extends Model
{
    /**
     * Registra o asocia un Cliente con un User.
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

            //Buscar cliente por ruc o ced o email
            $cliente = Clientes::where('cli_ruc_ced', $doc)
                ->orWhere('cli_email', $email)
                ->first();

            //Buscar user por email
            $user = User::where('email', $email)->first();

            // Si cliente existe y tiene cuenta existente
            if ($cliente && !is_null($cliente->user_id)) {
                throw new DomainException('Este cliente ya tiene una cuenta registrada. Inicie sesión.');
            }

            // Si no existe user se lo crea
            if (!$user) {
                $user = User::create([
                    'name'     => $data['cli_nombre'],
                    'email'    => $email,
                    'password' => Hash::make($data['password']),
                    'rol'      => 'cliente',
                ]);
            }

            // Asociar y Crear cliente
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
