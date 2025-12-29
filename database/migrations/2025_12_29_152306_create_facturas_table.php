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
        Schema::create('facturas', function (Blueprint $table) {
            $table->char('id_factura', 15)->primary();
            $table->char('id_cliente', 15);
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->text('fac_descripcion');
            $table->decimal('fac_subtotal',10,2);
            $table->decimal('fac_iva',10,2);
            $table->decimal('fac_total',10,2);
            $table->enum('fac_estado',['ABI','ANU','APR'])->default('ABI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
