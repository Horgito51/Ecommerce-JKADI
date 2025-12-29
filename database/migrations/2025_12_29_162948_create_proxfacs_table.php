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
        Schema::create('proxfac', function (Blueprint $table) {
            $table->char('id_factura', 15);
            $table->char('id_producto',15);
            $table->integer('pxf_cantidad');
            $table->decimal('pxf_precio',10,2);
            $table->decimal('pxf_subtotal',10,2);
            $table->enum('pxf_estado',['ABI','ANU','APR'])->default('ABI');
            $table->primary(['id_factura', 'id_producto']);

            $table->foreign('id_factura')
                ->references('id_factura')
                ->on('facturas');
            $table->foreign('id_producto')
                ->references('id_producto')
                ->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxfac');
    }
};
