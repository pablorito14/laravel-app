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
      Schema::create('facturas', function (Blueprint $table) {
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->id();
        $table->string('cliente',50);
        $table->date('fecha');
        $table->integer('comprobante');
        $table->tinyInteger('estado');
        $table->double('total',10,2);
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
        Schema::dropIfExists('facturas');
    }
};
