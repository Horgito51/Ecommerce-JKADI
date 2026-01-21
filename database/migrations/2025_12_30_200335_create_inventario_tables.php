<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
    {
        Schema::create('recepciones', function (Blueprint $table) {
            $table->char('id_recibo', 7)->primary();
            $table->char('rec_descripcion', 30);
            $table->dateTime('rec_fechahora');
            $table->integer('rec_num_produc');
            $table->char('estado_rec', 3)->default('ACT');
            $table->timestamps();
        });
        Schema::create('ajustes', function (Blueprint $table) {
            $table->char('id_ajuste', 7)->primary();

            $table->char('aju_descripcion', 30);
            $table->dateTime('aju_fechahora');
            $table->integer('aju_num_produc');
            $table->char('estado_aju', 3)->default('ACT');
            $table->timestamps();
        });

        Schema::create('entregas', function (Blueprint $table) {
            $table->char('id_entrega', 7)->primary();

            $table->char('ent_descripcion', 30);
            $table->dateTime('ent_fechahora');
            $table->integer('ent_num_produc');
            $table->char('estado_ent', 3)->default('ACT');
            $table->timestamps();
        });

        Schema::create('proxrec', function (Blueprint $table) {
            $table->char('id_recibo', 7);
            $table->char('id_producto', 15);
            $table->integer('pxr_cantidad');
            $table->integer('pxr_qty_recibida');
            $table->char('estado_pxr', 3)->default('ACT');

            $table->primary(['id_recibo', 'id_producto']);

            $table->foreign('id_recibo')
                  ->references('id_recibo')
                  ->on('recepciones');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos');
        });

        Schema::create('proxaju', function (Blueprint $table) {
            $table->char('id_ajuste', 7);
            $table->char('id_producto', 15);
            $table->integer('pxa_cantidad');
            $table->integer('pxa_qty_ajustada');
            $table->char('estado_pxa', 3)->default('ACT');

            $table->primary(['id_ajuste', 'id_producto']);

            $table->foreign('id_ajuste')
                  ->references('id_ajuste')
                  ->on('ajustes');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos');
        });

        Schema::create('proxent', function (Blueprint $table) {
            $table->char('id_entrega', 7);
            $table->char('id_producto', 15);
            $table->integer('pxe_cantidad');
            $table->integer('pxe_qty_entregada');
            $table->char('estado_pxe', 3)->default('ACT');

            $table->primary(['id_entrega', 'id_producto']);

            $table->foreign('id_entrega')
                  ->references('id_entrega')
                  ->on('entregas');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proxent');
        Schema::dropIfExists('proxaju');
        Schema::dropIfExists('proxrec');
        Schema::dropIfExists('entregas');
        Schema::dropIfExists('ajustes');
        Schema::dropIfExists('recepciones');
    }
};
