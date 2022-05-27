<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProduct>
 */
class UserProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

         /* Array con todos los tipos de piezas que hay */
         $tipos=['Embrague', 'Transmision', 'Valvula', 'Freno', 'Rueda', 'Cambio', 'Pedal', 'Espejo', 'Motor', 'Turbo', 'Supercargador', 'Radiador', 'Amortiguador'];
         $tipoAleatorio=$tipos[array_rand($tipos,1)]; /* Aqui obtenemos el nombre del tipo aleatorio */

         $nombre=$this->faker->words(8, true); /* Genera una frase con 8 palabras sin punto al final en formato string gracias al true que lleva */
         $nombreSinEspacios=str_replace(" ","_",$nombre); /* Reemplazamos todos los espacios por una barraBaja en la cadena que generó anteriormente faker de 8 palabras */

         /* Obtenemos el id de un usuario aleatorio */
         $userAsignado=User::all()->random(); /* Obtenemos un usuario aleatorio (esto nos devuelve un array asociativo con sus datos) */
         $nombreUserAsignadoSinEspacios=str_replace(" ","_",$userAsignado->name); /* Obtenemos el nombre y le quitamos los espacios en blanco*/


         /* Se crea un directorio para cada usuario donde dentro se guardaran los productos que tengan a la venta */
         Storage::makeDirectory("carmotor/tienda_Usuarios/$nombreUserAsignadoSinEspacios/$nombreSinEspacios");

         $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker)); #Cambiamos el proveedor de imagenes ya que el anterior ha fallado
        return [
            //

            'nombre'=>$nombre, /* El nombre generado anteriormente */
            'descripcion'=>$this->faker->text(100), /* Un texto con 100 caracteres */

            'imagen'=>"carmotor/tienda_Usuarios/$nombreUserAsignadoSinEspacios/$nombreSinEspacios/".$this->faker->picsum("public/storage/carmotor/tienda_Usuarios/$nombreUserAsignadoSinEspacios/$nombreSinEspacios", 640, 480, null, false),
            'imagen1'=>$this->faker->boolean(50) ? "carmotor/tienda_Usuarios/$nombreUserAsignadoSinEspacios/$nombreSinEspacios/".$this->faker->picsum("public/storage/carmotor/tienda_Usuarios/$nombreUserAsignadoSinEspacios/$nombreSinEspacios", 640, 480, null, false) : null,
            'imagen2'=>$this->faker->boolean(50) ? "carmotor/tienda_Usuarios/$nombreUserAsignadoSinEspacios/$nombreSinEspacios/".$this->faker->picsum("public/storage/carmotor/tienda_Usuarios/$nombreUserAsignadoSinEspacios/$nombreSinEspacios", 640, 480, null, false) : null,
            /* Las dos ultimas imagenes se ponen asi para que en algunos casos solo se llegue a crear 1 imagen, en otros 2 o 3 imagenes */

            'precio'=>$this->faker->randomFloat(2,10,9999), /* un float aleatorio entre 10 y 9999 con 2 decimales */
            'fecha_venta'=>$this->faker->dateTimeBetween('-20 days', '+30 days'), /* Retorna una fecha aleatoria desde 20 dias antes a 30 dias despues desde la fecha de hoy */
            'kms'=>random_int(1000, 100000), /* Int aleatorio entre 1000 y 100000 */
            'tipo'=>$tipoAleatorio, //Selecciona un tipo aleatorio del array de tipos
            'user_id'=>$userAsignado, /* Obtenemos el id del usuario aleatorio */

            'slug'=>Str::slug($nombre, '-')
       ];
    }
}
