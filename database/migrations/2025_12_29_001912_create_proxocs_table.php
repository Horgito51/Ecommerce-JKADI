<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('proxoc', function (Blueprint $table) {

            // Claves
            $table->char('id_compra', 10);
            $table->char('id_producto', 15);

            // Datos del detalle
            $table->integer('pxo_cantidad');
            $table->decimal('pxo_valor', 10, 3);
            $table->decimal('pxo_subtotal', 10, 3);

            $table->char('estado_pxoc', 3);

            // PK compuesta
            $table->primary(['id_compra', 'id_producto']);

            // FKs
            $table->foreign('id_compra')
                  ->references('id_compra')
                  ->on('compras')
                  ->onDelete('cascade');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxocs');
    }
};
