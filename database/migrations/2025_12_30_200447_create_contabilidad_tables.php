<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
    {

        Schema::create('tipo_cuenta', function (Blueprint $table) {
            $table->char('id_tipo_cta', 3)->primary();
            $table->char('tip_descripcion', 7);
            $table->timestamps();
        });

        Schema::create('cuentas', function (Blueprint $table) {
            $table->char('id_cuenta', 15)->primary();
            $table->char('cue_descripcion', 60);
            $table->char('cue_tipo', 3);

            // DEBE
            for ($i = 0; $i <= 13; $i++) {
                $table->decimal('cue_debe' . str_pad($i, 2, '0', STR_PAD_LEFT), 7, 2)->default(0);
            }

            // HABER
            for ($i = 0; $i <= 13; $i++) {
                $table->decimal('cue_haber' . str_pad($i, 2, '0', STR_PAD_LEFT), 7, 2)->default(0);
            }

            $table->char('estado_cue', 3)->default('ACT');

            $table->foreign('cue_tipo')
                  ->references('id_tipo_cta')
                  ->on('tipo_cuenta');

            $table->timestamps();
        });

        Schema::create('asientos', function (Blueprint $table) {
            $table->char('id_asiento', 10)->primary(); // 👈 AJUSTE PEDIDO
            $table->char('asi_descripcion', 30);
            $table->decimal('asi_total_debe', 7, 2)->default(0);
            $table->decimal('asi_total_haber', 7, 2)->default(0);
            $table->dateTime('asi_fechahora');
            $table->char('estado_asi', 3)->default('ACT');
            $table->timestamps();
        });

        Schema::create('ctaxasi', function (Blueprint $table) {
            $table->char('id_asiento', 10);
            $table->char('id_cuenta', 15);
            $table->decimal('cxa_debe', 7, 2)->default(0);
            $table->decimal('cxa_haber', 7, 2)->default(0);
            $table->char('estado_cxa', 3)->default('ACT');

            $table->primary(['id_asiento', 'id_cuenta']);

            $table->foreign('id_asiento')
                  ->references('id_asiento')
                  ->on('asientos');

            $table->foreign('id_cuenta')
                  ->references('id_cuenta')
                  ->on('cuentas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ctaxasi');
        Schema::dropIfExists('asientos');
        Schema::dropIfExists('cuentas');
        Schema::dropIfExists('tipo_cuenta');
    }
};
