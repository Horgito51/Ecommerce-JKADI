<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TriggerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("

CREATE OR REPLACE FUNCTION calcular_saldo_final()
RETURNS TRIGGER AS $$
BEGIN
    NEW.pro_saldo_final := COALESCE(NEW.pro_saldo_inicial, 0)
                         + COALESCE(NEW.pro_qty_ingresos, 0)
                         - COALESCE(NEW.pro_qty_egresos, 0)
                         + COALESCE(NEW.pro_qty_ajustes, 0);
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER trigger_actualizar_saldo_final
    BEFORE INSERT OR UPDATE
    ON public.productos
    FOR EACH ROW
    EXECUTE FUNCTION calcular_saldo_final();

UPDATE public.productos
SET pro_saldo_final = COALESCE(pro_saldo_inicial, 0)
                    + COALESCE(pro_qty_ingresos, 0)
                    - COALESCE(pro_qty_egresos, 0)
                    + COALESCE(pro_qty_ajustes, 0);



        ");
    }
}
