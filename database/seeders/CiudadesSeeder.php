<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ciudades;
use Illuminate\Database\Seeder;

class CiudadesSeeder extends Seeder
{
    public function run(): void
    {
        $ciudades=['Ambato','Quito','Guayaquil','Cuenca','Loja','Machala','Manta','Esmeraldas','Tulcán',
        'Ibarra','Riobamba','Latacunga','Santo Domingo','Portoviejo','Salinas','Puyo','Tena','Zamora','Nueva Loja','Macas'];

        foreach($ciudades as $ciu_descripcion){
            Ciudades::create(['ciu_descripcion'=>$ciu_descripcion]);
        }
    }
}
