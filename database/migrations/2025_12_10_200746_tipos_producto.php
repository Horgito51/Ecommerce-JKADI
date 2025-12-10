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
                Schema::create('tipos_producto', function (Blueprint $table) {

            // primary key CHAR(3)
            $table->char('id_tipo', 3)->primary();

            $table->string('tipo_descripcion', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_producto');
    }
};
