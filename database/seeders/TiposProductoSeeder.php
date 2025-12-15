<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TiposProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_producto')->insert([
            [
                'id_tipo' => 'BEB',
                'tipo_descripcion' => 'Bebidas y Chocolates',
            ],
            [
                'id_tipo' => 'CAR',
                'tipo_descripcion' => 'Cárnicos y Embutidos',
            ],
            [
                'id_tipo' => 'CON',
                'tipo_descripcion' => 'Condimentos y Aceites',
            ],
            [
                'id_tipo' => 'GAL',
                'tipo_descripcion' => 'Panadería y Galletas',
            ],
            [
                'id_tipo' => 'GRN',
                'tipo_descripcion' => 'Granos y Cereales',
            ],
            [
                'id_tipo' => 'HEL',
                'tipo_descripcion' => 'Lácteos y Refrigerados',
            ],
            [
                'id_tipo' => 'OTR',
                'tipo_descripcion' => 'Limpieza e Higiene',
            ],
        ]);
    }
}
