<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UnidadesMedidasProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unidades_medidas')->insert([
            ['id_unidad_medida' => 'BLL', 'um_descripcion' => 'Botella'],
            ['id_unidad_medida' => 'CJ',  'um_descripcion' => 'Caja'],
            ['id_unidad_medida' => 'CJA', 'um_descripcion' => 'Caja Grande'],
            ['id_unidad_medida' => 'CM',  'um_descripcion' => 'Centímetro'],
            ['id_unidad_medida' => 'DZA', 'um_descripcion' => 'Docena'],
            ['id_unidad_medida' => 'FT',  'um_descripcion' => 'Pie'],
            ['id_unidad_medida' => 'GL',  'um_descripcion' => 'Galón'],
            ['id_unidad_medida' => 'GR',  'um_descripcion' => 'Gramo'],
            ['id_unidad_medida' => 'IN',  'um_descripcion' => 'Pulgada'],
            ['id_unidad_medida' => 'KG',  'um_descripcion' => 'Kilogramo'],
            ['id_unidad_medida' => 'LB',  'um_descripcion' => 'Libra'],
            ['id_unidad_medida' => 'LT',  'um_descripcion' => 'Litro'],
            ['id_unidad_medida' => 'M',   'um_descripcion' => 'Metro'],
            ['id_unidad_medida' => 'ML',  'um_descripcion' => 'Mililitro'],
            ['id_unidad_medida' => 'MM',  'um_descripcion' => 'Milímetro'],
            ['id_unidad_medida' => 'OZ',  'um_descripcion' => 'Onza'],
            ['id_unidad_medida' => 'PAR', 'um_descripcion' => 'Par'],
            ['id_unidad_medida' => 'PK',  'um_descripcion' => 'Paquete'],
            ['id_unidad_medida' => 'ROL', 'um_descripcion' => 'Rollo'],
            ['id_unidad_medida' => 'UND', 'um_descripcion' => 'Unidad'],
        ]);
    }
}
