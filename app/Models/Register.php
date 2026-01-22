<?php

namespace App\Models;

use App\Models\User;
use App\Models\Clientes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DomainException;

class Register extends Model
{
    /**
     * Caso B (Wizard): Existe cliente (por documento) y NO tiene user_id.
     * - Crea el User con email+password
     * - Asocia ese user al cliente existente
     */
    public static function crearUserYAsociarAClienteExistente(string $doc, string $email, string $password)
    {
        $doc   = trim($doc);
        $email = trim(mb_strtolower($email));

        return DB::transaction(function () use ($doc, $email, $password) {

            // 1) Cliente SOLO por documento
            $cliente = Clientes::where('cli_ruc_ced', $doc)->first();

            if (!$cliente) {
                throw new DomainException('No se encontró un cliente con ese documento.');
            }

            if (!is_null($cliente->user_id)) {
                throw new DomainException('Este cliente ya tiene una cuenta registrada. Inicie sesión.');
            }

            // (Opcional recomendado): exigir que el email coincida con el registrado en tienda
            // Si quieres permitir cambiar email aquí, comenta este bloque.
            if (!empty($cliente->cli_email) && mb_strtolower(trim($cliente->cli_email)) !== $email) {
                throw new DomainException('El correo ingresado no coincide con el correo registrado para este documento.');
            }

            // 2) Evitar duplicar users por email
            if (User::where('email', $email)->exists()) {
                throw new DomainException('Este correo ya está registrado. Inicie sesión o use otro correo.');
            }

            // 3) Crear user (name sale del cliente existente)
            $user = User::create([
                'name'     => $cliente->cli_nombre ?? 'Cliente',
                'email'    => $email,
                'password' => Hash::make($password),
                'rol'      => 'cliente',
            ]);

            // 4) Asociar
            $cliente->user_id   = $user->id;
            $cliente->cli_email = $email;
            $cliente->save();

            return $user;
        });
    }

    /**
     * Caso A: Cliente NO existe (Registro completo)
     * - Crea User + crea Cliente asociado
     */
    public static function registrarCliente(array $data)
    {
        $email = trim(mb_strtolower($data['cli_email']));
        $doc   = trim($data['cli_ruc_ced']);

        return DB::transaction(function () use ($data, $email, $doc) {

            // 1) Cliente SOLO por documento
            $cliente = Clientes::where('cli_ruc_ced', $doc)->first();

            // Si el cliente existe y ya tiene cuenta
            if ($cliente && !is_null($cliente->user_id)) {
                throw new DomainException('Este cliente ya tiene una cuenta registrada. Inicie sesión.');
            }

            // 2) Email no debe estar usado por otro user
            if (User::where('email', $email)->exists()) {
                throw new DomainException('Este correo ya está registrado. Inicie sesión o use otro correo.');
            }

            // 3) Crear user
            $user = User::create([
                'name'     => $data['cli_nombre'],
                'email'    => $email,
                'password' => Hash::make($data['password']),
                'rol'      => 'cliente',
            ]);

            // 4) Crear o asociar cliente
            if ($cliente) {
                // Por seguridad/consistencia: si llegó aquí con cliente existente sin user_id, lo asociamos.
                $cliente->user_id       = $user->id;
                $cliente->cli_email     = $email;
                $cliente->cli_nombre    = $data['cli_nombre'];
                $cliente->cli_telefono  = $data['cli_telefono'];
                $cliente->ciudad_id     = $data['ciudad_id'];
                $cliente->cli_direccion = $data['cli_direccion'];
                $cliente->save();
            } else {
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
