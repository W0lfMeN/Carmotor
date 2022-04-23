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
        /* TABLA DE LOS PRODUCTOS DE SEGUNDA MANO */
        Schema::create('user_products', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->text('descripcion');
            $table->date('fecha_venta');
            $table->float('precio', 6,2);
            $table->integer('kms');

            /* Imagenes. 1 de ellas es obligatoria, las otras 2 opcionales */
            $table->string('imagen');
            $table->string('imagen1')->nullable();
            $table->string('imagen2')->nullable();
            $table->enum('tipo', ['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador']);

            /* Clave Foranea */
            $table->foreignId('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('user_products');
    }
};
