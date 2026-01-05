<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProceduresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("
            CREATE OR REPLACE PROCEDURE public.aprobar_factura(
    IN p_idfactura CHAR(10)
)
LANGUAGE plpgsql
AS $$
DECLARE
    v_asiento_id    CHAR(20);
    v_subtotal_f    NUMERIC(11,2);
    v_iva           NUMERIC(11,2);
    v_total         NUMERIC(11,2);
    v_sum_debe      NUMERIC(11,2);
    v_sum_haber     NUMERIC(11,2);
BEGIN
    SELECT fac_subtotal,
           fac_iva,
           fac_subtotal + fac_iva
    INTO v_subtotal_f, v_iva, v_total
    FROM facturas
    WHERE id_factura = p_idfactura;

    IF NOT FOUND THEN
        RAISE EXCEPTION '❌ La factura % no existe', TRIM(p_idfactura);
    END IF;
    v_asiento_id := 'A' || TRIM(p_idfactura);

    -- Cabecera asiento
    INSERT INTO asientos (
        id_asiento,
        asi_descripcion,
        asi_total_debe,
        asi_total_haber,
        asi_fechahora,
        estado_asi
    )
    VALUES (
        v_asiento_id,
        'Factura venta productos',
        0,
        0,
        NOW(),
        'ABI'
    );

    -- Detalle contable
    INSERT INTO ctaxasi VALUES
        (v_asiento_id, '1.1.01.01.01', v_total, 0, 'ABI'),       -- Clientes
        (v_asiento_id, '2.1.07.01.02.01', 0, v_iva, 'ABI'),     -- IVA
        (v_asiento_id, '4.1.01.01', 0, v_subtotal_f, 'ABI');   -- Ingresos

    -- Calcular totales asiento
    SELECT
        COALESCE(SUM(cxa_debe), 0),
        COALESCE(SUM(cxa_haber), 0)
    INTO v_sum_debe, v_sum_haber
    FROM ctaxasi
    WHERE id_asiento = v_asiento_id;

    -- Validación contable
    IF v_sum_debe <> v_sum_haber THEN
        RAISE EXCEPTION '❌ Asiento desbalanceado: Debe=% Haber=%',
            v_sum_debe, v_sum_haber;
    END IF;

    -- Actualizar cabecera asiento
    UPDATE asientos
    SET asi_total_debe = v_sum_debe,
        asi_total_haber = v_sum_haber
    WHERE id_asiento = v_asiento_id;

    UPDATE productos pr
    SET pro_qty_egresos = COALESCE(pr.pro_qty_egresos, 0) + d.total_egreso
    FROM (
        SELECT
            id_producto,
            SUM(pxf_cantidad) AS total_egreso
        FROM proxfac
        WHERE id_factura = p_idfactura
          AND pxf_estado = 'ABI'
        GROUP BY id_producto
    ) d
    WHERE pr.id_producto = d.id_producto;
    UPDATE proxfac
    SET pxf_estado = 'APR'
    WHERE id_factura = p_idfactura;

    UPDATE facturas
    SET fac_estado = 'APR'
    WHERE id_factura = p_idfactura;

EXCEPTION
    WHEN OTHERS THEN
        ROLLBACK;
        RAISE EXCEPTION
            '❌ Error al aprobar factura % | %',
            TRIM(p_idfactura), SQLERRM;
END;
$$;

CREATE OR REPLACE PROCEDURE public.aprobar_compra(
	IN p_compra character)
LANGUAGE 'plpgsql'
AS $$
DECLARE
    v_estado       CHAR(3);
    v_detalles     INT;
    v_existe       INT;

    v_subtotal     NUMERIC(10,3);
    v_iva          NUMERIC(10,3);
    v_total        NUMERIC(10,3);

    v_num_asiento  INT;
    v_id_asiento   CHAR(10);
BEGIN
    -- ===============================
    -- VALIDAR EXISTENCIA
    -- ===============================
    SELECT COUNT(*)
    INTO v_existe
    FROM compras
    WHERE TRIM(id_compra) = TRIM(p_compra);

    IF v_existe = 0 THEN
        RAISE EXCEPTION '❌ La orden % NO existe.', TRIM(p_compra);
    END IF;

    -- ===============================
    -- OBTENER ESTADO
    -- ===============================
    SELECT estado_oc
    INTO v_estado
    FROM compras
    WHERE TRIM(id_compra) = TRIM(p_compra);

    IF v_estado = 'APR' THEN
        RAISE EXCEPTION '❌ La orden % YA está aprobada.', TRIM(p_compra);
    END IF;

    IF v_estado = 'ANU' THEN
        RAISE EXCEPTION '❌ No se puede aprobar una orden anulada.';
    END IF;

    -- ===============================
    -- VALIDAR DETALLES
    -- ===============================
    SELECT COUNT(*)
    INTO v_detalles
    FROM proxoc
    WHERE TRIM(id_compra) = TRIM(p_compra);

    IF v_detalles = 0 THEN
        RAISE EXCEPTION '❌ La orden % NO tiene detalles.', TRIM(p_compra);
    END IF;

    -- ===============================
    -- APROBAR DETALLES
    -- ===============================
    UPDATE proxoc
    SET estado_pxoc = 'APR'
    WHERE TRIM(id_compra) = TRIM(p_compra);

    -- ===============================
    -- APROBAR CABECERA
    -- ===============================
    UPDATE compras
    SET estado_oc = 'APR'
    WHERE TRIM(id_compra) = TRIM(p_compra);

    -- ===============================
    -- OBTENER TOTALES
    -- ===============================
    SELECT oc_subtotal, oc_iva, oc_total
    INTO v_subtotal, v_iva, v_total
    FROM compras
    WHERE TRIM(id_compra) = TRIM(p_compra);

    -- ===============================
    -- ACTUALIZAR STOCK (INGRESOS)
    -- ===============================
    UPDATE productos p
    SET pro_qty_ingresos = COALESCE(p.pro_qty_ingresos,0) + d.total_cantidad
    FROM (
        SELECT id_producto, SUM(pxo_cantidad) AS total_cantidad
        FROM proxoc
        WHERE TRIM(id_compra) = TRIM(p_compra)
        GROUP BY id_producto
    ) d
    WHERE p.id_producto = d.id_producto;

    -- ===============================
    -- GENERAR ASIENTO
    -- ===============================
    SELECT COALESCE(MAX(SUBSTRING(id_asiento FROM 4)::INT), 0) + 1
    INTO v_num_asiento
    FROM asientos
    WHERE id_asiento LIKE 'ASI%';

    v_id_asiento := 'ASI' || LPAD(v_num_asiento::TEXT, 4, '0');

    INSERT INTO asientos (
        id_asiento, asi_descripcion,
        asi_total_debe, asi_total_haber,
        asi_fechahora, estado_asi
    ) VALUES (
        v_id_asiento,
        'Compra aprobada: ' || TRIM(p_compra),
        v_total, v_total,
        NOW(), 'ABI'
    );

    -- ===============================
    -- DETALLE CONTABLE
    -- ===============================
    INSERT INTO ctaxasi VALUES
        (v_id_asiento, '1.1.03.01.02', v_subtotal, 0, 'ABI'),
        (v_id_asiento, '1.1.05.01.01', v_iva, 0, 'ABI'),
        (v_id_asiento, '2.1.08.',      0, v_total, 'ABI');

    -- ===============================
    -- MENSAJE FINAL
    -- ===============================
    RAISE NOTICE '✔ Orden aprobada correctamente: %', TRIM(p_compra);
    RAISE NOTICE '✔ Detalles aprobados           : %', v_detalles;
    RAISE NOTICE '✔ Asiento generado             : %', v_id_asiento;

EXCEPTION
    WHEN OTHERS THEN
        RAISE EXCEPTION '❌ Error inesperado: %', SQLERRM;
END;
$$;
ALTER PROCEDURE public.aprobar_compra(character)
    OWNER TO postgres;


        ");
    }
}
