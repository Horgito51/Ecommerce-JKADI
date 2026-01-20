<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id(); // PK

            $table->string('usuario', 50);
            $table->string('accion', 100);
            $table->string('tabla_objeto', 50);
            $table->timestamp('fecha_accion')->useCurrent();
            $table->string('detalle', 4000)->nullable();

            $table->string('ip', 45);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
