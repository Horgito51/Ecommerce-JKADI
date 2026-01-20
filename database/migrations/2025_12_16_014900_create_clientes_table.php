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
        Schema::create('clientes', function (Blueprint $table) {
            $table->char('id_cliente', 15)->primary();
            $table->char('cli_nombre', 50);
            $table->char('cli_ruc_ced',13)->unique();
            $table->char('cli_direccion',100);
            $table->char('cli_telefono',10);
            $table->char('cli_email',50)->unique();
            $table->foreignId('ciudad_id')->references('id')->on('ciudades')
            ->onDelete('restrict');
            $table->enum('estado_cli', ['ACT', 'INA', 'SUS'])->default('ACT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
