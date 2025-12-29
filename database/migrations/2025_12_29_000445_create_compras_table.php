<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->char('id_compra', 10)->primary();
            $table->char('id_proveedor', 10);
            $table->decimal('oc_subtotal', 10, 3)->default(0);
            $table->decimal('oc_iva', 10, 3)->default(0);
            $table->decimal('oc_total', 10, 3)->default(0);
            $table->char('estado_oc', 3);
             $table->timestamps();

            // Foreign key (si existe la tabla proveedores)
            $table->foreign('id_proveedor')
                  ->references('id_proveedor')
                  ->on('proveedores');
        });

        //indice para estado_oc
         Schema::table('compras', function (Blueprint $table) {
             $table->index('estado_oc', 'idx_compras_estado');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
