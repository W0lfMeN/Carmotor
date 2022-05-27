<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Aqui creamos los productos y los relacionamos con algunas marcas (brands) y usuarios (users)

        $productos=\App\Models\Product::factory(200)->create(); /* Crea 100 productos */
        $brandsIds=Brand::pluck('id')->toArray(); /* Con esto obtenemos todos los ids de las marcas en un array */
        # $usersIds=User::pluck('id')->toArray(); /* Con esto obtenemos todos los ids de los usuarios en un array */

        /* Foreach que asigna marcas y usuarios asociados a cada producto creado de forma aleatoria */
        foreach($productos as $producto){
            /* Primero asociamos marcas */

            $marcas=array_slice($brandsIds, 0, random_int(1, count($brandsIds))); /* Escoge unos cuantos ids aleatorios del array de marcas (brandsIds) */
            $producto->brands()->attach($marcas); /* Se los asigna al producto en concreto */

            /* ---------------------------------------------------------------- */

            /* # Ahora asociamos usuarios
            $usuarios=array_slice($usersIds, 0, random_int(1, count($usersIds))); # Escoge unos cuantos ids aleatorios del array usersIds
            $producto->users()->attach($usuarios); # Se los asigna al producto en concreto */

        }
    }
}
