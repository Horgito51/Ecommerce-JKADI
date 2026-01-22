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
            Schema::create('productos', function (Blueprint $table) {

            $table->char('id_producto', 15)->primary();

            $table->string('pro_descripcion', 255);
            $table->char('id_tipo', 3)->nullable();
            $table->char('pro_um_compra', 3)->nullable();
            $table->char('pro_um_venta', 3)->nullable();

            $table->decimal('pro_valor_compra', 7, 2)->check('pro_valor_compra >= 0')   ;
            $table->decimal('pro_precio_venta', 7, 2)->check('pro_precio_venta >= pro_valor_compra');

            $table->integer('pro_saldo_inicial')->nullable();
            $table->integer('pro_qty_ingresos')->unsigned()->default(0);
            $table->integer('pro_qty_egresos')->unsigned()->default(0);
            $table->integer('pro_qty_ajustes')->unsigned()->default(0);
            $table->integer('pro_saldo_final')->unsigned()->default(0)->check('pro_saldo_final >= 0');

            $table->char('estado_prod', 3)->default('ACT');
            $table->char('user_id', 50)->nullable();

            $table->timestamp('fecha_alta')->useCurrent();
            $table->timestamp('fecha_baja')->nullable();

            $table->string('img', 500)->nullable();

            // Foreign keys
            $table->foreign('id_tipo')
                ->references('id_tipo')->on('tipos_producto')
                ->onUpdate('no action')->onDelete('no action');

            $table->foreign('pro_um_compra')
                ->references('id_unidad_medida')->on('unidades_medidas')
                ->onUpdate('no action')->onDelete('no action');

            $table->foreign('pro_um_venta')
                ->references('id_unidad_medida')->on('unidades_medidas')
                ->onUpdate('no action')->onDelete('no action');
        });

        // Índices adicionales
        Schema::table('productos', function (Blueprint $table) {
            $table->index(['id_tipo', 'id_producto', 'pro_descripcion'], 'idx_btree_tres_campos');
            $table->unique('pro_descripcion', 'unique_pro_descripcion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
