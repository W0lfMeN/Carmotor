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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            /* Campos */
            $table->string('nombre')->unique();
            $table->text('descripcion');
            /* Imagenes. 1 de ellas es obligatoria, las otras 2 opcionales */
            $table->string('imagen');
            $table->string('imagen1')->nullable();
            $table->string('imagen2')->nullable();
            $table->float('precio', 6,2); /* 6 cifras de las cuales 2 son decimales */
            /*  */

            /* Campo para el SEO (Este campo lo usaremos en la url para el posicionamiento SEO) */
            $table->string('slug')->nullable();
            /*  */

            $table->integer('cantidad'); /* Cantidad de stock de este producto */
            $table->date('fecha_venta');
            $table->enum('tipo', ['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador']);
            /* Cambio = Caja de cambios */

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
        Schema::dropIfExists('products');
    }
};
