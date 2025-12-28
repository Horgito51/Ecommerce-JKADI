<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ignacio',
            'email' => 'ignacio@jkadi.com',
            'password' => Hash::make('12345'),
            'rol' => 'gerente_bodega',
        ]);

        User::create([
            'name' => 'JORGE',
            'email' => 'jorge@jkadi.com',
            'password' => Hash::make('12345'),
            'rol' => 'gerente_compras',
        ]);

        User::create([
            'name' => 'ANAHI',
            'email' => 'anahi@jkadi.com',
            'password' => Hash::make('12345'),
            'rol' => 'gerente_ventas',
        ]);

        User::create([
            'name' => 'DANNY',
            'email' => 'danny@jkadi.com',
            'password' => Hash::make('12345'),
            'rol' => 'admin',
        ]);
    }
}
