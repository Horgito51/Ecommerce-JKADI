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
   Schema::create('proveedores', function (Blueprint $table) {
            $table->char('id_proveedor', 10)->primary();
            $table->char('prv_nombre', 40);
            $table->char('prv_ruc_ced', 13)->unique();
            $table->char('prv_telefono', 10)->nullable();
            $table->char('prv_mail', 60);
            $table->foreignId('id_ciudad')->references('id')->on('ciudades')
            ->onDelete('restrict');
            $table->char('prv_celular', 10);
            $table->char('prv_direccion', 60);
            $table->char('estado_prv', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
