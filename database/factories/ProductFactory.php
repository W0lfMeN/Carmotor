<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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

        Storage::makeDirectory("carmotor/tienda/$tipoAleatorio/$nombreSinEspacios"); /* Se crea un directorio por cada producto */

        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker)); #Cambiamos el proveedor de imagenes ya que el anterior ha fallado

        if($this->faker->boolean(50)){
            $imagen1="carmotor/tienda/$tipoAleatorio/$nombreSinEspacios/".$this->faker->picsum("public/storage/carmotor/tienda/$tipoAleatorio/$nombreSinEspacios", 640, 480, null, false);
        }else{
            $imagen1=null;
        }

        if($this->faker->boolean(50) && $imagen1!=null){

            $imagen2="carmotor/tienda/$tipoAleatorio/$nombreSinEspacios/".$this->faker->picsum("public/storage/carmotor/tienda/$tipoAleatorio/$nombreSinEspacios", 640, 480, null, false);
        }else{
            $imagen2=null;
        }

        return [
            //rellenamos la tabla con datos de prueba

            'nombre'=>$nombre, /* El nombre generado anteriormente */
            'descripcion'=>$this->faker->text(100), /* Un texto con 100 caracteres */

            'imagen'=>"carmotor/tienda/$tipoAleatorio/$nombreSinEspacios/".$this->faker->picsum("public/storage/carmotor/tienda/$tipoAleatorio/$nombreSinEspacios", 640, 480, null, false),
            'imagen1'=>$imagen1,
            'imagen2'=>$imagen2,

            'slug'=>Str::slug($nombre, '-'),
            /* Las dos ultimas imagenes se ponen asi para que en algunos casos solo se llegue a crear 1 imagen, en otros 2 o 3 imagenes */

            'precio'=>$this->faker->randomFloat(2,10,9999), /* un float aleatorio entre 10 y 9999 con 2 decimales */
            'cantidad'=>random_int(0,10), /* Si es 0 quiere decir que no hay stock */

            'fecha_venta'=>$this->faker->dateTimeBetween('-20 days', '+30 days'), /* Retorna una fecha aleatoria desde 20 dias antes a 30 dias despues desde la fecha de hoy */
            'tipo'=>$tipoAleatorio, //Selecciona un tipo aleatorio del array anterior

        ];
        /* FACTORY COMPLETADO */
    }


}
