<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalles_factura', function (Blueprint $table) {
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->id();
        $table->foreignId('factura_id')
              ->constrained('facturas')
              ->onUpdate('cascade')
              ->onDelete('cascade');
        $table->foreignId('servicio_id')
              ->constrained('servicios')
              ->onUpdate('cascade')
              ->onDelete('cascade');
        
        $table->double('importe',10,2);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_factura');
    }
};
