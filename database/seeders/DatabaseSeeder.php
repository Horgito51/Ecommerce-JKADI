<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            TiposProductoSeeder::class,
            UnidadesMedidasProductosSeeder::class,
            CiudadesSeeder::class,
            ProductoSeeder::class,
            ProveedorSeeder::class,
            ContabilidadSeeder::class,
            // TriggerSeeder::class,
        ]);
    }
}
