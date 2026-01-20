<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TriggersFSeeder extends Seeder
{
    public function run(): void
    {
        DB::unprepared("
        -- =========================
        -- FUNCIÓN GENERAL DE LOGS
        -- =========================
        CREATE OR REPLACE FUNCTION log_auditoria()
        RETURNS TRIGGER AS $$
        BEGIN
            IF (TG_OP = 'INSERT') THEN
                INSERT INTO logs(usuario, accion, tabla_objeto, detalle, ip)
                VALUES (
                    current_user,
                    'INSERT',
                    TG_TABLE_NAME,
                    'Datos nuevos: ' || row_to_json(NEW)::text,
                    'DB_TRIGGER'
                );
                RETURN NEW;

            ELSIF (TG_OP = 'UPDATE') THEN
                INSERT INTO logs(usuario, accion, tabla_objeto, detalle, ip)
                VALUES (
                    current_user,
                    'UPDATE',
                    TG_TABLE_NAME,
                    'Antes: ' || row_to_json(OLD)::text || ' | Después: ' || row_to_json(NEW)::text,
                    'DB_TRIGGER'
                );
                RETURN NEW;

            ELSIF (TG_OP = 'DELETE') THEN
                INSERT INTO logs(usuario, accion, tabla_objeto, detalle, ip)
                VALUES (
                    current_user,
                    'DELETE',
                    TG_TABLE_NAME,
                    'Datos eliminados: ' || row_to_json(OLD)::text,
                    'DB_TRIGGER'
                );
                RETURN OLD;
            END IF;
        END;
        $$ LANGUAGE plpgsql;

        -- =========================
        -- TRIGGERS POR TABLA
        -- =========================

        DROP TRIGGER IF EXISTS trg_productos_log ON productos;
        CREATE TRIGGER trg_productos_log
        AFTER INSERT OR UPDATE OR DELETE ON productos
        FOR EACH ROW EXECUTE FUNCTION log_auditoria();

        DROP TRIGGER IF EXISTS trg_proveedores_log ON proveedores;
        CREATE TRIGGER trg_proveedores_log
        AFTER INSERT OR UPDATE OR DELETE ON proveedores
        FOR EACH ROW EXECUTE FUNCTION log_auditoria();

        DROP TRIGGER IF EXISTS trg_compras_log ON compras;
        CREATE TRIGGER trg_compras_log
        AFTER INSERT OR UPDATE OR DELETE ON compras
        FOR EACH ROW EXECUTE FUNCTION log_auditoria();

        DROP TRIGGER IF EXISTS trg_facturas_log ON facturas;
        CREATE TRIGGER trg_facturas_log
        AFTER INSERT OR UPDATE OR DELETE ON facturas
        FOR EACH ROW EXECUTE FUNCTION log_auditoria();

        DROP TRIGGER IF EXISTS trg_clientes_log ON clientes;
        CREATE TRIGGER trg_clientes_log
        AFTER INSERT OR UPDATE OR DELETE ON clientes
        FOR EACH ROW EXECUTE FUNCTION log_auditoria();

        ");
    }
}
