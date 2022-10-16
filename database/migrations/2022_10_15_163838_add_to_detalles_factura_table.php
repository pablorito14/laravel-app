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
        Schema::table('detalles_factura', function (Blueprint $table) {
            
            // $table->after('id',function($table) {
            //       $table->foreignId('factura_id')
            //             ->constrained('facturas')
            //             ->onUpdate('cascade')
            //             ->onDelete('cascade');
  
            // });

            $table->after('factura_id',function($table) {
                  $table->foreignId('servicio_id')
                        ->constrained('facturas')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
  
            });

            // $table->after('factura_id',function($table){
            //   $table->integer('servicio');
            // });
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalles_factura', function (Blueprint $table) {
            $table->dropForeign('detalles_factura_factura_id_foreign');
            $table->dropColumn('factura_id');
        });
    }
};
