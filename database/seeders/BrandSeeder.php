<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Aqui creamos unas cuantas marcas

        Brand::create([
            'nombre'=>'Toyota',
            'descripcion'=>'Empresa japonesa de fabricación de automóviles. Fundada en 1933 por Kiichiro Toyoda. Es especialmente notoria por ser pionera en la producción y comercialización masiva de automóviles basados en la tecnología de combustible híbrida como el modelo Prius o la división de automóviles de lujo Lexus.'
        ]);

        Brand::create([
            'nombre'=>'Honda',
            'descripcion'=>'Honda Motor Co., Ltd. es una empresa de origen japonés que fabrica automóviles, propulsores para vehículos terrestres, acuáticos y aéreos, motocicletas, robots y componentes para la industria automotriz.'
        ]);

        Brand::create([
            'nombre'=>'Peugeot',
            'descripcion'=>'Peugeot es una marca de automóviles francesa, que pertenece al grupo Stellantis. Se basa en la fabricación de turismos, vehículos comerciales, automóviles de carreras, servicios de movilidad como alquiler de vehículos, bicicletas, scooters, así como útiles de cocina como saleros, pimenteros y molinillos de café.'
        ]);

        Brand::create([
            'nombre'=>'Renault',
            'descripcion'=>'Renault es un fabricante francés de automóviles tanto de lujo como de turismo, vehículos comerciales y automóviles de carreras.'
        ]);

        Brand::create([
            'nombre'=>'Mercedes-Benz',
            'descripcion'=>'Mercedes-Benz es una empresa alemana fabricante de vehículos, filial de la compañía Mercedes-Benz Group. La marca es reconocida por sus automóviles de lujo, deportivos, autobuses, camiones, utilitarios, y vehículos todo terreno.'
        ]);

        Brand::create([
            'nombre'=>'Opel',
            'descripcion'=>'Opel Automobile GmbH es una empresa alemana de automóviles, propiedad de la multinacional Stellantis.'
        ]);

        Brand::create([
            'nombre'=>'Citroen',
            'descripcion'=>'Citroën es una marca francesa constructora de automóviles fundada en 1919 por André Citroën, propiedad de Stellantis.'
        ]);

        Brand::create([
            'nombre'=>'Volskwagen',
            'descripcion'=>'Volkswagen es un fabricante de automóviles alemán con sede en Wolfsburgo, Baja Sajonia. Volkswagen es la marca original y más vendida del Grupo Volkswagen, primer fabricante de automóviles del mundo al año 2021.'
        ]);

        Brand::create([
            'nombre'=>'Seat',
            'descripcion'=>'SEAT es una empresa española de automóviles fundada por el desaparecido Instituto Nacional de Industria el 9 de mayo de 1950. Pertenece al grupo Volskwagen.'
        ]);

        Brand::create([
            'nombre'=>'Dodge',
            'descripcion'=>'Dodge es una marca de automóviles estadounidense, llamada originalmente Dodge Brothers Motor Vehicle Company, propiedad de Stellantis.'
        ]);

        Brand::create([
            'nombre'=>'Ford',
            'descripcion'=>'Ford Motor Company, más conocida como Ford, es una empresa multinacional de origen estadounidense, especializada en la industria automotriz.'
        ]);

        Brand::create([
            'nombre'=>'Mercedes-AMG',
            'descripcion'=>'Mercedes-AMG GmbH es una división de automóviles de altas prestaciones propiedad de Mercedes-Benz Group.'
        ]);

        Brand::create([
            'nombre'=>'Fiat',
            'descripcion'=>'Fiat Automobiles siglas de Fabbrica Italiana Automobili Torino es una histórica marca italiana de automóviles.'
        ]);

        Brand::create([
            'nombre'=>'Audi',
            'descripcion'=>'Audi es una empresa multinacional alemana fabricante de automóviles de alta gama y deportivos. Su sede central se encuentra en Ingolstadt, Baviera y forma parte desde 1965 del Grupo Volkswagen.'
        ]);

        Brand::create([
            'nombre'=>'Suzuki',
            'descripcion'=>'Suzuki Motor Corporation, es una empresa japonesa dedicada a la fabricación de automóviles, motocicletas, motores fuera borda, y variedad de productos equipados con motores de combustión.​'
        ]);

        Brand::create([
            'nombre'=>'Dacia',
            'descripcion'=>'Dacia es una marca de automóviles de Rumania, fundada en el año 1966 y perteneciente al grupo Renault desde 1999.'
        ]);



    }
}
