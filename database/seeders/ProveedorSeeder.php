<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('proveedores')->insert([

            [
                'id_proveedor' => 'PRV001',
                'prv_nombre' => 'Repuestos Andinos',
                'prv_ruc_ced' => '8825779270001',
                'prv_telefono' => '022361265',
                'prv_mail' => 'repuestosandinos1000@empresa.com',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0972442941',
                'prv_direccion' => 'Av. Principal 1000 y Secundaria',
                'estado_prv' => 'INA',
            ],

            [
                'id_proveedor' => 'PRV002',
                'prv_nombre' => 'AgroInsumos Q',
                'prv_ruc_ced' => '1790012345001',
                'prv_telefono' => '022345678',
                'prv_mail' => 'agroq@empresa.com',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0991111111',
                'prv_direccion' => 'Av. Amazonas N34-12',
                'estado_prv' => 'ACT',
            ],

            [
                'id_proveedor' => 'PRV003',
                'prv_nombre' => 'Lácteos Andinos',
                'prv_ruc_ced' => '0999999999001',
                'prv_telefono' => '032233445',
                'prv_mail' => 'lacteos@andinos.ec',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0982222222',
                'prv_direccion' => 'Av. 12 de Noviembre',
                'estado_prv' => 'ACT',
            ],

            [
                'id_proveedor' => 'PRV004',
                'prv_nombre' => 'Distribuidora Cuencana',
                'prv_ruc_ced' => '0102030405001',
                'prv_telefono' => '072345678',
                'prv_mail' => 'ventas@cuencana.com',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0983333333',
                'prv_direccion' => 'Av. Loja y Remigio',
                'estado_prv' => 'INA',
            ],

            [
                'id_proveedor' => 'PRV005',
                'prv_nombre' => 'TecnoGuayas',
                'prv_ruc_ced' => '0991234567001',
                'prv_telefono' => '004223344',
                'prv_mail' => 'info@tecnoguayas.ec',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0994444444',
                'prv_direccion' => 'Cdla. Kennedy Nueva',
                'estado_prv' => 'ACT',
            ],

            [
                'id_proveedor' => 'PRV006',
                'prv_nombre' => 'Repuestos Manabí',
                'prv_ruc_ced' => '1313131313001',
                'prv_telefono' => '052223345',
                'prv_mail' => 'contacto@manabirep.ec',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0985555555',
                'prv_direccion' => 'Vía Crucita km 3',
                'estado_prv' => 'INA',
            ],

            [
                'id_proveedor' => 'PRV007',
                'prv_nombre' => 'Importadora Loja',
                'prv_ruc_ced' => '1100110011001',
                'prv_telefono' => '072112233',
                'prv_mail' => 'ventas@lojaimport.ec',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0996666666',
                'prv_direccion' => 'Av. Universitaria',
                'estado_prv' => 'INA',
            ],

            [
                'id_proveedor' => 'PRV008',
                'prv_nombre' => 'Tropicales Esmeraldas',
                'prv_ruc_ced' => '0808080808001',
                'prv_telefono' => '062233445',
                'prv_mail' => 'ventas@esmtropics.com',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0987777777',
                'prv_direccion' => 'Av. Malecón',
                'estado_prv' => 'ACT',
            ],

            [
                'id_proveedor' => 'PRV009',
                'prv_nombre' => 'Frutas Tungurahua',
                'prv_ruc_ced' => '1800180018001',
                'prv_telefono' => '032221100',
                'prv_mail' => 'frutas@tunga.ec',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0998888888',
                'prv_direccion' => 'Parque Industrial',
                'estado_prv' => 'ACT',
            ],

            [
                'id_proveedor' => 'PRV010',
                'prv_nombre' => 'Carnes Imbabura',
                'prv_ruc_ced' => '1001001001001',
                'prv_telefono' => '062211223',
                'prv_mail' => 'ventas@imbacarnes.com',
                'id_ciudad' => rand(1, 20),
                'prv_celular' => '0989999999',
                'prv_direccion' => 'Av. Teodoro Gómez',
                'estado_prv' => 'SUS',
            ],

        ]);
    }
}
