<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();

            // Usuario (NULL = carrito anonimo)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Token para identificar carrito anonimo (cookie)
            $table->uuid('token')->unique();

            // Estado del carrito
            $table->enum('estado', ['activo', 'convertido', 'abandonado'])->default('activo');

            // Expiracion del carrito
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
