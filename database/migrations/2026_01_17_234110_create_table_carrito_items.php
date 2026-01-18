<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito_items', function (Blueprint $table) {
            $table->id();

            // FK al carrito
            $table->foreignId('carrito_id')
                ->constrained('carritos')
                ->cascadeOnDelete();

            // FK al producto (CHAR 15)
            $table->char('id_producto', 15);

            $table->integer('cantidad')->default(1);

            // Precio capturado al momento de agregar
            $table->decimal('precio_unitario', 10, 2);

            $table->timestamps();

            // Evitar duplicados de producto en el mismo carrito
            $table->unique(['carrito_id', 'id_producto']);

            // Foreign key manual (porque no es BIGINT)
            $table->foreign('id_producto')
                ->references('id_producto')
                ->on('productos')
                ->onUpdate('no action')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_items');
    }
};
