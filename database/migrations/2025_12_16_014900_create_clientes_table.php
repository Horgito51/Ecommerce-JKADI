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
            $table->id();
            $table->string('cli_nombre', 50);
            $table->string('cli_ruc_ced',13);
            $table->string('cli_direccion',100);
            $table->string('cli_telefono',10);
            $table->string('cli_email',50);
            $table->foreignId('ciudad_id')->references('id')->on('ciudades');
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
