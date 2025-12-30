<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ContabilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(
            "
            INSERT INTO TIPO_CUENTA (id_Tipo_Cta, tip_Descripcion) VALUES ('MAY', 'Mayor');
INSERT INTO TIPO_CUENTA (id_Tipo_Cta, tip_Descripcion) VALUES ('DET', 'Detalle');



INSERT INTO CUENTAS VALUES ('1.', 'Activos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.', 'Corriente', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.', 'Efectivo Y Equivalentes De Efectivo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.', 'Caja', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.01', 'Caja General', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.02', 'Caja Tarjetas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.03', 'Caja Posfechados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.04', 'Caja Chica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.05', 'Transferencias Internas (Cero)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.06', 'Caja Reposición Administración', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.07', 'Fondo Rotativo ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.01.99', 'Cuenta de Regularización(Siempre Cero)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.02.', 'Bancos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.02.01', 'Banco Pichincha', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.02.02', 'Produbanco', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.01.02.03', 'Banco Austro', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.', 'Activos Financieros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.01.', 'Activos Financieros A Valor Razonable Con Cambios En Resulta', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.01.01', 'Activos Financieros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.02.', 'Activos Financieros Disponibles Para La Venta', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.03.', 'Activos Financieros Mantenidos Hasta Su Vencimiento', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.04.', '(-) Provisión Por Deterioro', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.04.01', '(-) Provisión Por Deterioro', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.05.', 'Documentos Y Cuentas Por Cobrar Clientes No Relacionados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.05.01', 'Clientes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.05.02', 'Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.05.03', 'Cheques Devueltos, Protestados O Cambio Cheques', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.05.04', 'Transitoria Cruce Clientes (Siempre Cero)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.05.05', 'Transitoria Retenciones Atrazadas (Siempre Cero)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.06.', 'Documentos Y Cuentas Por Cobrar Clientes Relacionados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.06.01', 'Clientes Relacionados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.07.', 'Otras Cuentas Por Cobrar Relacionadas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.07.01', 'Prestamos Accionistas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.07.02', 'Otras Cuentas Por Cobrar Relacionados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.07.03', 'Dividendos Accionistas / Socios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.08.', 'Cuentas Por Cobrar Empleados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.08.01', 'Anticipo Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.08.02', 'Prestamos Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.08.03', 'Faltantes Caja Por Cobrar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.09.', 'Cuentas Por Cobrar', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.09.01', 'Garantía Por Arriendo Oficina', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.09.02', 'Cheques En Garantía', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.09.03', 'Otras Cuentas Por Cobrar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.11.', '(-) Provisión De Cuentas Incobrables', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.02.11.01', '(-) Provisión De Cuentas Incobrables', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.', 'Inventarios', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.01.', 'Inv. De Prod. Terminados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.01.01', 'Inventarios De Prod. Terminados Con Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.01.02', 'Inventarios De Prod. Terminados Sin Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.01.03', 'Inventario Transitorio Ofertas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


	INSERT INTO CUENTAS VALUES ('1.1.03.01.04', 'Inventario Transitorio Cambio De Mercadería Con Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.01.05', 'Inventario Transitorio Cambio Mercadería Sin Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.01.06', 'Inventario Transitorio Recepciones de Compras', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.03.', 'Inv. De Sum. O Mat. A Ser Consumidos En Proceso', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.03.01', 'Envases plásticos -Botellas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.03.02', 'Mangas termoencogibles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.03.03', 'Sal en grano', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.03.04', 'Tapas para botellas ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.03.05', 'Fajillas para botellas ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.05.', 'Inventarios De Materia Prima', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.07.', 'Importaciones En Transito', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.07.01', 'Importación En Transito No. Amg-Di1722', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.07.02', 'Importación En Transito No. Amg-Di180409', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.07.03', 'Importación En Transito No. Amg-Di180416', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.08.', 'Obras En Construcción', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.09.', 'Inventarios Repuestos, Herramientas Y Accesorios', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.09.01', 'Inventarios Repuestos, Herramientas Y Accesorios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.10.', 'Producción En Proceso', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.10.01', 'Producción En Proceso', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.11.', 'Provisión De Inventarios Por Valor Neto De Realización', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.11.01', 'Provisión De Inventarios Por Valor Neto De Realización', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


	INSERT INTO CUENTAS VALUES ('1.1.03.12.', 'Provisión De Inventarios Por Deterioro Físico', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.12.01', 'Provisión De Inventarios Por Deterioro Físico', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.13.', 'Transferencias Internas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.03.13.01', 'Transferencias Internas Inv. (Cero)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.', 'Servicios Y Otros Pagados Anticipados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.01.', 'Seguros Pagados Por Anticipado', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.01.01', 'Seguros A', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.02.', 'Arriendo Pagados Por Anticipado', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.02.01', 'Arriendo Pagados Por Anticipado', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.03.', 'Anticipo A Proveedores', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.03.01', 'Anticipo A Laboratorios Negrete ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.03.02', 'Anticipo Proveedor Construcción ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.03.03', 'Anticipo Otros Proveedores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.04.03.04', 'Anticipo Proveedores Gastos Importación', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.05.', 'Activos Por Impuestos Corrientes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.05.01.', 'Crédito Tributario A Favor De La Empresa Iva', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.05.01.01', 'Iva En Compras', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.05.01.02', 'Retenciones Iva De Clientes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.05.02.', 'Crédito Tributario A Favor De La Empresa Renta', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.1.05.02.01', 'Anticipo Impuesto A La Renta', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

		INSERT INTO CUENTAS VALUES ('1.1.05.02.02', 'Impuestos Retenidos Por Clientes Años Anteriores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.1.05.02.03', 'Impuestos Retenidos Por Clientes Año Actual', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.1.05.02.04', 'Impuestos A La Renta A Favor Años Anteriores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.2.', 'Activo No Corriente', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.2.01.', 'Propiedad, Planta Y Equipo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.2.01.01.', 'Costo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.2.01.01.01', 'Terrenos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.2.01.01.02', 'Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
		INSERT INTO CUENTAS VALUES ('1.2.01.01.03', 'Construcciones En Curso', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

	INSERT INTO CUENTAS VALUES ('1.2.01.01.04', 'Instalaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.01.05', 'Muebles Y Enseres', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.01.06', 'Maquinaria Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.01.07', 'Naves, Aeronaves, Barcazas Y Similares', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.01.08', 'Equipos De Computación', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.01.09', 'Vehículos, Equipos De Transporte Y Equipo Caminero Móvil', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



	INSERT INTO CUENTAS VALUES ('1.2.01.01.10', 'Otras Propiedades, Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.01.11', 'Repuestos Y Herramientas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.', '(-) Depreciación Acumulada Propiedades, Planta Y Equipo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.02', 'Dep.Acum. Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.03', 'Dep.Acum. Construcciones En Curso', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.04', 'Dep.Acum. Instalaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.05', 'Dep.Acum. Muebles Y Enseres', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.06', 'Dep.Acum. Maquinaria Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.07', 'Dep.Acum. Naves, Aeronaves, Barcazas Y Similares', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.08', 'Dep.Acum. Equipos De Computación', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.09', 'Dep.Acum.EquiposDeTransporteYEquipoCaminero', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



	INSERT INTO CUENTAS VALUES ('1.2.01.02.10', 'Dep.Acum. Otras Propiedades, Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.02.11', 'Dep.Acum. Repuestos Y Herramientas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.', '(-)DeterioroAcumuladoDePropiedades,PlantaYEquipo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.01', 'Det.Acum. Terrenos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.02', 'Det.Acum. Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.03', 'Det.Acum. Construcciones En Curso', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.04', 'Det.Acum. Instalaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.05', 'Det.Acum. Muebles Y Enseres', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



	INSERT INTO CUENTAS VALUES ('1.2.01.03.06', 'Det.Acum. Maquinaria Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.07', 'Det.Acum. Naves, Aeronaves, Barcazas Y Similares', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.08', 'Det.Acum. Equipos De Computación', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.09', 'Det.Acum. Vehículos, Equipos De Transporte ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.10', 'Det.Acum. Otras Propiedades,Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.01.03.11', 'Det.Acum. Repuestos Y Herramientas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.02.', 'Propiedades De Inversion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.02.01.', 'Costo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


	INSERT INTO CUENTAS VALUES ('1.2.02.01.01', 'Prop.Inversion Terrenos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.02.01.02', 'Prop.Inversion Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.02.02.', '(-)Deterioro Acumulado De Propiedades De Inversion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.02.02.01', 'Det.Acum. Prop.Inversion Terrenos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.02.02.02', 'Det.Acum. Prop.Inversion Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.', 'Activo Intangible', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.01.', 'Costo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.01.01', 'Plusvalias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.01.02', 'Marcas, Patentes, Derecho De Llave', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.01.03', 'Software Contable Y Ventas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.02.', '(-) Amortizacion Acumalada De Activos Intangibles', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



	INSERT INTO CUENTAS VALUES ('1.2.04.02.01', 'Amortiz.Acum. Plusvalias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.02.02', 'Amortiz .Acum. Marcas,Derecho De Llave,Cuotas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.03.', '(-) Deterioro Acumulado De Activos Intangibles', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.03.01', 'Det.Acum. Plusvalias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.04.03.02', 'Det.Acum. Marcas, Patentes, Derecho De Llave,Cuotas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
	INSERT INTO CUENTAS VALUES ('1.2.05.', 'Activos Por Impuestos Diferidos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('1.2.05.01', 'Activos Por Impuestos Diferidos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('1.2.06.', 'Activos Financieros No Corrientes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('1.2.06.01.', 'Activos Financieros Hasta Su Vencimiento', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('1.2.06.01.01', 'Depositos A Plazo Banco A', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.', 'Pasivo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.', 'Pasivo Corriente', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.03.', 'Cuentas Y Documentos Por Pagar', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.03.01.', 'Proveedores', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.03.01.01', 'Proveedores Locales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.03.01.02', 'Proveedores Del Exterior', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.03.01.03', 'Transitoria Cruce Proveedores (Siempre Cero)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('2.1.04.', 'Obligaciones Con Instituciones Financieras', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.04.01.', 'Bancos Locales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.04.01.01', 'Préstamo Banco Pichincha K 210000.00', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.04.01.02', 'Préstamo Banco Pichincha K 100000.00', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.04.02.', 'Bancos Del Exterior', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.04.02.01', 'Banco A', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.05.', 'Provisiones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.05.01.', 'Contingencias Laborales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.05.01.01', 'Contingencias Laborales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.05.02.', 'Contingencias Tributarias', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.05.02.01', 'Contingencias Tributarias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.', 'Otras Obligaciones Corrientes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.', 'Con La Administracion Tributaria', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.', 'Retencion En La Fuente', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.01', 'Retencion Fuente En Relacion De Dependencia (302)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.02', 'Honorarios Profesionales 10% (303)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.03', 'Predomina El Intelecto 8%  (304)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.04', 'Predomina Mano De Obra 2% (307)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


INSERT INTO CUENTAS VALUES ('2.1.07.01.01.05', 'Entre Sociedades 2% (308)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.06', 'Publicidad Y Comunicacion 1% (309)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.07', 'Transporte Privado De Pasajeros O Carga 1% (310)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.08', 'Transferencia De Bienes Muebles 1% (312)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.09', 'Arriendamiento Mercantil (319)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.10', 'Arrendamiento Bienes Inmuebles 8% (320)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.11', 'Seguros Y Reaseguros (Primas Y Cesiones) (322)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.12', 'Rendimientos Financieros 2% (323)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.13', 'Otras Retenciones 1% (343)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.14', 'Otras Retenciones 2% (344)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.15', 'Otras Retenciones 8% (345)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('2.1.07.01.01.16', 'Otras Retenciones 25% (343)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.17', 'Formulario 103 Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.18', 'Régimen Microempresarial 1.75% (351)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.01.19', 'Otras Retenciones 1.75% (3440)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.02.', 'Impuesto Al Valor Agregado', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.02.01', 'Iva En Ventas O Servicios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.02.02', 'Retencion Del Iva 30% (721)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.02.03', 'Retencion Del Iva 70% (723)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.02.04', 'Retencion Del Iva 100% (725)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.02.05', 'Retencion Del Iva 10%', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('2.1.07.01.02.06', 'Retencion Del Iva 20%', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.02.07', 'Formulario 104 Iva Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.03.', 'Impuestos Sri Por Liquidar', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.03.01', 'Facilidades De Pago', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.04.', 'Impuesto A Los Consumos Especiales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.01.04.01', 'ICE En Ventas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.02.', 'Impuesto A La Renta', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.02.01', 'Impuesto A La Renta Del Ejercicio Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.07.03.', 'Con El Instituto EcuatorianoSeguridadSocial', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.03.01', 'Aportes Personal Iess', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.03.02', 'Prestamos Quirografarios Iess', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.03.03', 'Fondos De Reserva Iess', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.03.04', 'Aporte Patronal Iess', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.03.05', 'Prestamos Hipotecarios Iess', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.03.06', 'Extension Conyugal Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.04.', 'Por Sueldos Beneficios De Ley A Empleados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.04.01', 'Sueldos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.04.02', 'Decimo Tercer Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.04.03', 'Decimo Cuarto Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('2.1.07.04.04', 'Vacaciones Provision', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.07.04.05', 'Fondos De Reserva Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.07.04.06', 'Liquidaciones Haberes Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.07.05.', 'Participacion Trabajadores Por Pagar', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.07.05.01', 'Participacion Trabajadores  Ejercicio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.07.06.', 'Dividendos Por Pagar', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.08.', 'Cuentas Por Pagar Relacionadas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.08.01.', 'Proveedor Relacionado', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.08.02.', 'Prestamos Relacionadas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.08.02.01', 'Prestamos Relacionadas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('2.1.09.', 'Otros Pasivos Financieros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.01.', 'Comisiones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.01.01', 'Señor A', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.02.', 'Otras Cuentas Por Pagar', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.02.01', 'Otras Cuentas Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.02.02', 'Anticipos En Ventas De Propiedad, Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.02.03', 'Arriendos Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.02.04', 'Depositos Por Identificar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.02.05', 'Comision Tarjetas (Transitoria)', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.02.99', 'Otras Cuentas Por Pagar Propinas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.03.', 'Tarjetas De Credito', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.03.01', 'Tarjeta A', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.1.09.03.02', 'Tarjeta B', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.04.', 'Prestamos De Terceros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.04.01', 'Prestamo Elva Elizalde', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.09.04.02', 'Préstamo Por Pagar Silvia Pantoja', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.10.', 'Anticipo De Clientes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.10.01.', 'Anticipo De Clientes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.1.10.01.01', 'Anticipo De Cliente Cobro Cartera ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.', 'Pasivo No Corriente', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.02.', 'Cuentas Y Documentos Por Pagar', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.02.01.', 'Proveedores Largo Plazo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('2.2.02.01.01', 'Proveedores Largo Plazo Locales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.02.01.02', 'Proveedores Largo Plazo Del Exterior', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('2.2.03.', 'Obligaciones Con Instituciones Financieras Largo Plazo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.03.01.', 'Prestamos Bcos Nacionales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.03.01.01', 'Prestamos Banco Pichicnha', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.03.02.', 'Prestamos Bcos Del Exterior', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.03.02.01', 'Banco A', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.04.', 'Cuentas Por Pagar Relacionadas Largo Plazo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.04.01.', 'Proveedor Relacionado Largo Plazo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.04.01.01', 'Empresa A', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.04.02.', 'Prestamos Relacionadas Largo Plazo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('2.2.04.02.01', 'Pasivo No Corriente - Juan Pantoja', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.07.', 'Provisiones Por Bebeficios A Empleados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.07.01.', 'Provisiones Por Bebeficios A Empleados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.07.01.01', 'Jubilacion Patronal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.07.01.02', 'Jubilacion Por Desahucio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.09.', 'Pasivo Diferido', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.09.01', 'Ingresos Diferidos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.09.02', 'Pasivos Por Impuestos Diferidos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('2.2.10.', 'Otros Pasivos Largo Plazo No Corrientes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.', 'Patrimonio Neto', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.1.', 'Capital', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.1.01.', 'Capital Suscrito O Asignando', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.1.01.01', 'Capital Suscrito O Asignando', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.1.01.02', 'Socio B', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.2.', 'Aportes De Socios O Accionistas Para Futura Capitalizacion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.2.01.', 'Aportes De Socios O Accionistas Para Futura Capitalizacion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


INSERT INTO CUENTAS VALUES ('3.2.01.01', 'Aportes De SociosAccionistas Para FuturaCapitalizacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.2.01.02', 'Socio B', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.4.', 'Reservas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.4.01.', 'Reservas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.4.01.01', 'Reserva Legal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.4.01.02', 'Reserva Facultativa Y Estatutaria', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.4.01.03', 'Reserva De Capital', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.4.01.04', 'Otras Reservas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.5.', 'Otros Resultados Integrales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.5.01.', 'Otros Resultados Integrales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.5.01.01', 'Superavit PorRevaluacionDe Act.Disponibles Para La Venta', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.5.01.02', 'Superavit Por Revaluacion De Propiedades, Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.5.01.03', 'Superavit Por Revaluacion De Activos Intangibles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('3.5.01.04', 'Otros Superavit Por Revaluacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.6.', 'Resultados Acumulados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.6.01.', 'Ganancias Acumuladas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.6.01.01', 'Ganancias Acumuladas Año N', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.6.02.', '(-)Perdidas Acumuladas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.6.02.01', '(-)Perdidas Acumuladas Año N', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.6.03.', 'Result. Acum. Provenientes De La Adopcion Por Primera Vez', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.6.03.01', 'Utilidad / Perdida Por Conversion De Niifs', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.7.', 'Resultados Del Ejercicio', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('3.7.01.', 'Resultados Del Ejercicio', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.7.01.01', 'Ganancia Neta Del Periodo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('3.7.01.02', '(-) Perdida Neta Del Periodo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.', 'Ingresos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.', 'Ingresos De Actividades Ordinarias', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.01.', 'Venta De Bienes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.01.01', 'Ventas Bienes Con Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.01.02', 'Ventas Bienes Sin Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.02.', '(-) Descuentos En Ventas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.02.01', 'Descuentos En Ventas Con Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.02.02', 'Descuentos En Ventas Sin Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.02.04', 'Otros Descuentos Ventas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.03.', '(-) Devoluciones En Ventas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('4.1.03.01', 'Devolucion En Ventas Con Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.1.03.02', 'Devolucion En Ventas Sin Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.', 'Otros Ingresos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.01.', 'Otros Ingresos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.01.01', 'Utilidad En Venta De Activos Fijos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.01.02', 'Ingreso Por Descuento En Ventas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.01.03', 'Otros  Ingresos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.01.04', 'Otros Ingresos Por Facturacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.01.05', 'Otros Ingresos Sobrantes Caja', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('4.2.01.06', 'Venta Activos Fijos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.', 'Egresos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.', 'Costos De Ventas Y Produccion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.', 'Materiales Utilizados O Productos Vendidos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.01.', 'Materiales Utilizados O Productos Vendidos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.01.01', 'Costo De Ventas Mercaderia Con Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.01.02', 'Costo De Ventas Mercaderia Sin Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.01.03', 'Descuento En Compras', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

----
INSERT INTO CUENTAS VALUES ('5.1.01.01.04', 'Descuento Por Pronto Pago', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.01.05', 'Otros Descuentos Compra', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.02.', 'GastoPorCantidades AnormalesProceso De Produccion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.02.01', 'Gasto Por Cantidades Anormales De Mano De Obra', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.01.02.02', 'Gasto Por Cantidades Anormales De Materiales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.02.', 'Materia Prima Consumida', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.02.01.', 'Materia Prima Consumida', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.02.01.01', 'Materia Prima Consumida', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.02.99.', 'Mp - Cta. Cierre Materia Prima Consumida', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.02.99.99', 'Mp -  Cta. Cierre Materia Prima Consumida', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.', 'Mano De Obra Directa', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.', 'Mod - Sueldos Y Beneficios Sociales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.01.', 'Mod - Sueldos Y DemasMateria Gravada Iess', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.01.01', 'Mod - Sueldos Unificados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.01.02', 'Mod - Horas Extras', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.01.03', 'Mod - Comisiones Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.01.04', 'Mod - Bonos Por Desempeño', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.01.05', 'Mod - Participacion Trabajadores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.02.', 'Mod-Aportes A La Seguridad Social(Incluido F. De Reserva)', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.02.01', 'Mod - Aporte Patronal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('5.1.03.01.02.02', 'Mod - Fondos De Reserva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.', 'Mod - Beneficios SocialesEIndemnizaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.01', 'Mod - Decimo Tercer Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.02', 'Mod - Decimo Cuarto Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.03', 'Mod - Vacaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.04', 'Mod - Remuneracion Adicionales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.05', 'Mod - Indemnizaciones Laborables', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.06', 'Mod - Movilizacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.01.03.07', 'Mod - Vacaciones Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.02.', 'Mod - Gasto Planes De Beneficios A Empleados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.02.01.', 'Mod - Gasto Jubilacion Patronal Y Desahucio', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.02.01.01', 'Mod - Gasto Jubilacion Patronal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.02.01.02', 'Mod - Gasto Desahucio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.03.', 'Mod - Cta De Cierre De Mano De Obra', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');









INSERT INTO CUENTAS VALUES ('5.1.03.03.99.', 'Mod - Cta De Cierre De Mano De Obra', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.03.03.99.99', 'Mod - Cta De Cierre De Mano De Obra', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.', 'Otros Costos Indirectos De Fabricacion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.', 'Cif - Depreciacione Planta Y Equipo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.01', 'Cif - Deprec. Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.02', 'Cif - Deprec. Instalaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.03', 'Cif - Deprec. Muebles Y Enseres', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.04', 'Cif - Deprec. Maquinaria Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.05', 'Cif - Deprec. Equipos De Computacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.06', 'Cif - Deprec. Vehiculos,Equipos De Transporte', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.01.07', 'Cif - Deprec. Equipo De Logistica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.03.', 'Cif - Deterioro', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.03.01', 'Cif - Deterioro Propiedades, Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.03.02', 'Cif - Deterioro Inventarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.03.03', 'Cif - Deterioro Instrumentos Financieros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.03.04', 'Cif - Deterioro Intangibles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.03.05', 'Cif - Deterioro Cuentas Por Cobrar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.03.06', 'Cif - Deterioro Otros Activos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');











INSERT INTO CUENTAS VALUES ('5.1.04.04.', 'Cif - Efecto Valor Neto De Realizacion Inventarios', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.04.01', 'Cif - Ajuste Valor Neto De Realizacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.06.', 'Cif - Mantenimiento Y Reparaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.06.01', 'Cif - Mant. Y Rep. De Equipos De Computacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.06.02', 'Cif - Mant. Y Rep. De Equipos De Oficina', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.06.03', 'Cif - Mant. Y Rep. De Vehiculos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.07.', 'Cif - Suministros Materiales Y Repuestos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.07.01', 'Cif - Material De Embalaje', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.07.02', 'Cif - Repuestos De Vehiculos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.07.03', 'Cif - Repuestos De Maquinaria', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.07.04', 'Cif-Mantenimiento sistema eléctrico', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.08.', 'Cif - Otros Costos De Produccion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.08.01', 'Cif - Servicio de Transporte de Materia Prima', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.08.02', 'Costo de Cireles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.99.', 'Cf - Cta De Cierre De Gastos Ind. De Fabricacion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.1.04.99.99', 'Cf - Cta De Cierre De Gastos Ind. De Fabricacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.', 'Gastos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.', 'Gastos De Ventas', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


INSERT INTO CUENTAS VALUES ('5.2.01.01.', 'Gv - Sueldos Y Demas Remun. Materia Gravada Iess', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.01.01', 'Gv - Sueldos Unificados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.01.02', 'Gv - Horas Extras', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.01.03', 'Gv - Comisiones Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.01.04', 'Gv - Bonos Por Desempeño', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.01.15', 'Gv - 15% Participacion Trabajadores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.02.', 'Gv - Aportes A La Seguridad Social (Incluido Fondo De Reserv', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.02.01', 'Gv - Aporte Patronal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.02.02', 'Gv - Fondos De Reserva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.03.', 'Gv - Beneficios Sociales E Indemnizaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.03.01', 'Gv - Decimo Tercer Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.03.02', 'Gv - Decimo Cuarto Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.03.03', 'Gv - Vacaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');






INSERT INTO CUENTAS VALUES ('5.2.01.03.04', 'Gv - Remuneracion Adicionales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.03.05', 'Gv - Indemnizaciones Laborables', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.03.06', 'Gv - Movilizacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.03.07', 'Gv - Vacaciones Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.04.', 'Gv - Gasto Planes De Beneficios A Empleados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.04.01', 'Gv - Gasto Jubilacion Patronal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.04.02', 'Gv - Gasto Desahucio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.05.', 'Gv - Honorarios, Comisiones Y Dietas Personas Naturales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.05.01', 'Gv - Servicios Legales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.05.02', 'Gv - Servicios Profesionales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.06.', 'Gv - Remuneraciones A Otros Trabajadores Autonomos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.06.01', 'Gv - Servicios Ocasionales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.06.02', 'Gv - Servicios De Impresion E Imprenta', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.06.03', 'Gv - Avaluos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.08.', 'Gv - Mantenimiento Y Reparaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');





INSERT INTO CUENTAS VALUES ('5.2.01.08.01', 'Gv - Mant. Y Rep. De Equipos De Computacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.08.02', 'Gv - Mant. Y Rep. De Equipos De Oficina', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.08.03', 'Gv - Mant. Y Rep. De Vehiculos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.08.04', 'Gv - Mant. Y Rep. De  Instalaciones Telefonicas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.09.', 'Gv - Arrendamiento Operativo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.09.01', 'Gv - Arrendamiento De Oficina', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.10.', 'Gv - Comisiones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.10.01', 'Gv - Comisiones A Vendedores Externos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.11.', 'Gv - Promocion Y Publicidad', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.11.01', 'Gv - Ferias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.11.02', 'Gv - Servicios De Publicidad', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.11.03', 'Gv - Publicidad Y Anuncios En Prensa', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.12.', 'Gv - Combustibles Y Lubricantes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.12.01', 'Gv - Combustibles De Vehiculos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.12.02', 'Gv - Lubricantes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


INSERT INTO CUENTAS VALUES ('5.2.01.14.', 'Gv - Seguros Y Reaseguros (Primas Y Cesiones)', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.14.01', 'Gv - Seguros De Vida', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.14.02', 'Gv - Seguros Generales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.14.03', 'Gv - Asistencia Medica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.15.', 'Gv - Transporte', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.15.01', 'Gv - Transporte De Personal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.15.02', 'Gv - Transporte De Carga', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('5.2.01.16.', 'Gv - Gastos De Gestion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.16.01', 'Gv - Refrigerios A Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.16.02', 'Gv - Atencion A Clientes / Proveedores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.16.03', 'Gv - Gasto Restaurantes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.16.04', 'Gv - Agasajo Navideño', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.17.', 'Gv - Gastos De Viajes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.17.01', 'Gv - Pasajes Aereos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.17.02', 'Gv - Hoteles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.17.03', 'Gv - Alimentacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.17.04', 'Gv - Movilizacion En Viajes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.18.', 'Gv - Agua, Energia, Luz Y Telecomunicaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.18.01', 'Gv - Energia Electrica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.18.02', 'Gv - Telefonia Celular', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.18.03', 'Gv - Telefonia Fija', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.18.04', 'Gv - Servicios De Internet', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.18.05', 'Gv - Agua', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.19.', 'Gv - Notarios Y Registradores De La Propiedad Y Mercantiles', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('5.2.01.19.01', 'Gv - Notarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.19.02', 'Gv - Registradores De La Propiedad Y Mercantiles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.', 'Gv - Impuestos, Contribuciones Y Otros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.01', 'Gv - Gasto Impuesto A La Renta', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.02', 'Gv - Gasto Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.03', 'Gv - Municipales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.04', 'Gv - Camara De Comercio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.05', 'Gv - Contribucion Superintendencia De Compañias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.06', 'Gv - Intereses Mora Y Multa', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.20.07', 'Gv - Impuestos Salida De Divisas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.21.', 'Gv - Depreciaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.21.01', 'Gv - Deprec. Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.21.02', 'Gv - Deprec. Instalaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.21.03', 'Gv - Deprec. Muebles Y Enseres', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.21.04', 'Gv - Deprec. Maquinaria Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('5.2.01.21.05', 'Gv - Deprec. Equipos De Computacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.21.06', 'Gv - Deprec.Vehiculos,Equipos De TransporteYEquipo Camine', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.21.07', 'Gv - Deprec. Equipo De Logistica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.22.', 'Gv - Amortizaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.22.01', 'Gv - Gastos Amortiz  Plusvalias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.22.02', 'Gv - Gasto Amort.Iz. Marcas, Patentes, Derecho De Llave', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.23.', 'Gv - Deterioro', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.23.01', 'Gv - Deterioro Propiedades, Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.23.02', 'Gv - Deterioro Inventarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.23.03', 'Gv - Deterioro Instrumentos Financieros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.23.04', 'Gv - Deterioro Intangibles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.23.05', 'Gv - Deterioro Cuentas Por Cobrar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.23.06', 'Gv - Deterioro Otros Activos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.', 'Gv - Otros  Gastos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.01', 'Gv - Suministros De Aseo Y Limpieza', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.02', 'Gv - Suministros Y Materiales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.04', 'Gv - Comisiones Tarjetas De Credito', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.05', 'Gv - Capacitacion Y Seminarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('5.2.01.27.07', 'Gv - Seguridad', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.09', 'Gv - Suscripciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.11', 'Gv - Atencion Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.12', 'Gv - Gastos Retenciones Asumidas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.13', 'Gv - Donaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.14', 'Gv - Uniformes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.2.01.27.15', 'Gv - Inventario Dañado U Obsoleto', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.', 'Gastos Adminitrativos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.', 'Ga - Gastos Administrativos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.01.', 'Ga - Sueldos Y Demas Remun. Materia Gravada Iess', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.01.01', 'Ga - Sueldos Unificados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('5.3.01.01.02', 'Ga - Horas Extras', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.01.03', 'Ga - Comisiones Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.01.04', 'Ga - Bonos Por Desempeño', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.01.05', 'Ga - Bonos Empleados No Deducibles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.01.15', 'Ga - 15% Participacion Trabajadores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.02.', 'Ga - Aportes A La Seguridad SocialFondo De Reserv', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.02.01', 'Ga - Aporte Patronal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.02.02', 'Ga - Fondos De Reserva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.02.03', 'Ga - Extension Conyugal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.', 'Ga - Beneficios Sociales E Indemnizaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.01', 'Ga - Decimo Tercer Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.02', 'Ga - Decimo Cuarto Sueldo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.03', 'Ga - Vacaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.04', 'Ga - Remuneracion Adicionales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.05', 'Ga - Indemnizaciones Laborables', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.06', 'Ga - Movilizacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.03.07', 'Ga - Vacaciones Por Pagar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.04.', 'Ga - Gasto Planes De Beneficios A Empleados', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.04.01', 'Ga - Gasto Jubilacion Patronal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.04.02', 'Ga - Gasto Desahucio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.05.', 'Ga - HonorariosComisionesYDietas Personas Naturales', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('5.3.01.05.01', 'Ga - Servicios Legales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.05.02', 'Ga - Servicios Profesionales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.06.', 'Ga - Remuneraciones A Otros Trabajadores Autonomos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.06.01', 'Ga - Servicios Ocasionales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.06.02', 'Ga - Servicios De Impresion E Imprenta', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.06.03', 'Ga - Análisis de laboratorio y  Permisos ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.06.04', 'Ga Servicios De Redes Sociales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.06.05', 'Ga - Servicios Seguridad Industrial', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.08.', 'Ga - Mantenimiento Y Reparaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.08.01', 'Ga - Mant. Y Rep. De Equipos De Computacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.08.02', 'Ga - Mant. Y Rep. De Equipos De Oficina', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.08.03', 'Ga - Mant. Y Rep. De Vehiculos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.08.04', 'Ga - Mant. Y Rep. De  Instalaciones Telefonicas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.08.05', 'Ga - Mantenimiento Instalaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.09.', 'Ga - Arrendamiento Operativo', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.09.01', 'Ga - Arrendamiento De Oficina', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.10.', 'Ga - Comisiones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.10.01', 'Ga - Comisiones A Vendedores Externos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('5.3.01.11.', 'Ga - Promocion Y Publicidad', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.11.01', 'Ga - Ferias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.11.02', 'Ga - Servicios De Publicidad', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.11.03', 'Ga - Publicidad Y Anuncios En Prensa', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.12.', 'Ga - Combustibles Y Lubricantes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.12.01', 'Ga - Combustibles De Vehiculos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.12.02', 'Ga - Lubricantes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.14.', 'Ga - Seguros Y Reaseguros (Primas Y Cesiones)', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.14.01', 'Ga - Seguros De Vida', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.14.02', 'Ga - Seguros Generales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.14.03', 'Ga - Asistencia Medica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.15.', 'Ga - Transporte', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.15.01', 'Ga - Transporte De Personal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.15.02', 'Ga - Transporte De Encomienda', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.16.', 'Ga - Gastos De Gestion', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('5.3.01.16.01', 'Ga - Refrigerios A Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.16.02', 'Ga - Atencion A Clientes/Proveedores', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.16.03', 'Ga - Gasto Restaurantes, Alimentacion Y Refrigerio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.16.04', 'Ga - Agasajo Navideño', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.16.05', 'Ga - Atencion Clientes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.17.', 'Ga - Gastos De Viajes', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.17.01', 'Ga - Pasajes Aereos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.17.02', 'Ga - Hoteles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.17.03', 'Ga - Alimentacion Y Refrigerio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.17.04', 'Ga - Movilizacion En Viajes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.17.05', 'Ga- Otros Gastos De Viajes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.18.', 'Ga - Agua, Energia, Luz Y Telecomunicaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.18.01', 'Ga - Energia Electrica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.18.02', 'Ga - Telefonia Celular', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.18.03', 'Ga - Telefonia Fija', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.18.04', 'Ga - Servicios De Internet', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.18.05', 'Ga - Agua', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.19.', 'Ga - Notarios Y Registradores De La Propiedad Y Mercantiles', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');



INSERT INTO CUENTAS VALUES ('5.3.01.19.01', 'Ga - Notarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.19.02', 'Ga - Registradores De La Propiedad Y Mercantiles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.', 'Ga - Impuestos, Contribuciones Y Otros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.01', 'Ga - Gasto Impuesto A La Renta', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.02', 'Ga - Gasto Iva', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.03', 'Ga - Patente Municipal', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.04', 'Ga - Camara De Comercio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.05', 'Ga - Contribucion Superintendencia De Compañias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.06', 'Ga - Intereses Mora Y Multa', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.07', 'Ga - Impuestos Salida De Divisas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.08', 'Ga- Impuesto Consumos Especiales Ice', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.09', 'Ga- Retenciones Asumidas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.20.10', 'Ga- 1.5 Por Mil ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.21.', 'Ga - Depreciaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.21.01', 'Ga - Deprec. Edificios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.21.02', 'Ga - Deprec. Instalaciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.21.03', 'Ga - Deprec. Muebles Y Enseres', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');

INSERT INTO CUENTAS VALUES ('5.3.01.21.04', 'Ga - Deprec. Maquinaria Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.21.05', 'Ga - Deprec. Equipos De Computacion', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.21.06', 'Ga - Deprec. Vehiculos,EquiposDeTransporteYEquipo Camine', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.21.07', 'Ga - Deprec. Equipo De Logistica', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.22.', 'Ga - Amortizaciones', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.22.01', 'Ga - Gastos Amortiz  Plusvalias', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.22.02', 'Ga - Gasto Amort.Iz. Marcas, Patentes, Derecho De Llave', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.23.', 'Ga - Deterioro', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.23.01', 'Ga - Deterioro Propiedades, Planta Y Equipo', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.23.02', 'Ga - Deterioro Inventarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.23.03', 'Ga - Deterioro Instrumentos Financieros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.23.04', 'Ga - Deterioro Intangibles', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.23.05', 'Ga - Deterioro Cuentas Por Cobrar', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.23.06', 'Ga - Deterioro Otros Activos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.', 'Ga - Otros  Gastos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.01', 'Ga - Suministros De Aseo Y Limpieza', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');




INSERT INTO CUENTAS VALUES ('5.3.01.27.02', 'Ga - Suministros Y Materiales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.05', 'Ga - Capacitacion Y Seminarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.07', 'Ga - Seguridad Y  Monitoreo ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.09', 'Ga - Suscripciones', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.11', 'Ga - Atencion Empleados', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.13', 'Ga - Donaciones Y Contribuciones Comuinidad', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.14', 'Ga - Uniformes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.15', 'Ga- Autoconsumo Suministros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.16', 'Ga - Autoconsumo Alimentos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.17', 'Ga- Autocunsomo Otros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.18', 'Otros Gastos Servicios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.19', 'Otros Gastos Bienes', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.3.01.27.20', 'Ga - Servicio Auditoria Sociedades', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.', 'Gastos Financieros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.', 'Gastos Financieros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.01.', 'Gastos Financieros', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');


INSERT INTO CUENTAS VALUES ('5.4.01.01.01', 'Gf - Intereses Bancarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.01.02', 'Gf - Gastos Bancarios', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.01.03', 'Gf - Gastos Financiamiento De Activos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.01.04', 'Gf - Diferencia En Cambio', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.01.05', 'Gf - Otros Costos Financieros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.01.06', 'Gf- Seguro Pagado En Préstamos', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.02.', 'Otros Gastos', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.02.01', 'Gf - Perdida En Inversiones En Asociadas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.4.01.02.02', 'Gf - Otros', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.5.', 'Gastos No Deducibles', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.5.01.', 'Gastos No Deducibles', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.5.01.01.', 'Gastos No Deducibles', 'MAY', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.5.01.01.01', 'Gnd - Gasto No Deducible Generales', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.5.01.01.02', 'Devolucion Juguetes 2017', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.5.01.01.03', 'Gnd- Ingreso Y Egreso Facturas Mal Emitidas', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
INSERT INTO CUENTAS VALUES ('5.5.01.01.04', 'Gastos No Deducible Ajuste Cuentas ', 'DET', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'ACT');
"



        );
    }
}
