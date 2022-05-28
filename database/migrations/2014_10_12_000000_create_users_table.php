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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('apellidos');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            /* Campo de rol (Pendiente de modificacion) */
            $table->enum('rol', [1,2])->default(1); /* 1 = USUARIO NORMAL || 2 = USUARIO ADMIN */
            $table->string('direccion'); /* guarda la direccion de la persona (ej: calle la piedra Nº 30 Piso 4B CP 04400 Almeria) */

            $table->rememberToken();

            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
