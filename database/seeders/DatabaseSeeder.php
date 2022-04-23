<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $this->crearCarpetas(); /* Funcion que crea las carpetas con cada una de las piezas */
        Storage::makeDirectory("carmotor/tienda_Usuarios"); /* Carpeta donde se guardaran los productos subidos por los usuarios. Aqui se guardaran por usuarios y no por tipo de pieza */

        \App\Models\User::factory(20)->create(); /* Crea 50 usuarios */
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
