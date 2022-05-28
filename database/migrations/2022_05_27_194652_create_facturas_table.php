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
            $table->id();

            $table->string('codigo')->unique();/* Codigo de factura unico */
            $table->string('user_nombre'); /* NO ES UNA REFERENCIA A TABLA USERS */
            $table->string('product_id'); /* Ids de los productos */
            $table->text('pedido'); /* Nombre de los productos */
            $table->string('direccion');
            $table->float('precio', 6,2); /* 6 cifras de las cuales 2 son decimales */

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
