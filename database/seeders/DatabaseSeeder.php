<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('carmotor'); /* Borra la carpeta raiz de las imagenes */
        Storage::deleteDirectory('profile-photos'); /* Borra la carpeta de las imagenes de los usuarios */
        
        $this->crearCarpetas(); /* Funcion que crea las carpetas con cada una de las piezas */
        Storage::makeDirectory("carmotor/tienda_Usuarios"); /* Carpeta donde se guardaran los productos subidos por los usuarios. Aqui se guardaran por usuarios y no por tipo de pieza */

        \App\Models\User::factory(20)->create(); /* Crea 20 usuarios */

        /* Me creo un usuario para hacer pruebas */
        User::create([
            'name' => "Carlos admin",
            'email' => "carlosjmsanchez@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

            'rol'=>2, /* 1 = Usuario normal || 2 = Usuario Admin */
            'direccion'=>"hola", /* Genera una direccion aleatoria */

            'remember_token' => Str::random(10),
        ]);

        $this->call(BrandSeeder::class); /* Llamamos al brandseeder para crear las marcas */
        $this->call(ProductSeeder::class); /* Llamamos al productseeder para crear los productos a la vez que se les asocia unas cuantas marcas */

        \App\Models\UserProduct::factory(30)->create();

    }

    public function crearCarpetas(){
        $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];

        /* Bucle que crea un directorio por cada elemento que hay en el array anterior */
        foreach($tipos as $tipo){
            Storage::makeDirectory("carmotor/tienda/$tipo"); /* Tienda hace referencia a la tienda principal */
        }
    }
}
