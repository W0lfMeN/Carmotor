@extends('layouts.plantillaAdmin')
@section('cabecera')
Editar el usuario de nombre {{$user->name}}
@endsection
@section('contenido')
<form action="{{route('users.store')}}" method="post">
    @csrf

    <div class="py-4 px-2 w-3/4 mx-auto border-black border-2 rounded-lg">
        {{-- Nombre y apellidos --}}

        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>

            @error('name')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="apellidos" id="apellidos" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="apellidos" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellidos</label>

            @error('apellidos')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        {{--  --}}

        {{-- Correo electronico --}}

        <div class="relative z-0 w-full mb-6 group">
            <input type="email" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>

            @error('email')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        {{--  --}}

        {{-- Contraseña y Repetir contraseña --}}

        <div class="relative z-0 w-full mb-6 group">
            <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
            <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>

            @error('password')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="password" name="password_confirmation" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
            <label for="password_confirmation" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar contraseña</label>
        </div>
        {{--  --}}

        {{-- Direccion --}}
        <label for="" class="mb-4 text-lg">Dirección</label>

        <div class="grid xl:grid-cols-2 xl:gap-6 pt-4">
            {{-- Calle --}}
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="calle" id="calle" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                <label for="calle" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Calle, Nº</label>

                @error('calle')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}
            {{-- Codigo postal --}}
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="cp" id="cp" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                <label for="cp" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Codigo Postal (CP)</label>

                @error('cp')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}
            {{-- Poblacion --}}
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="poblacion" id="poblacion" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                <label for="poblacion" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Poblacion</label>

                @error('poblacion')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}
            {{-- Provincia --}}
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="provincia" id="provincia" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                <label for="provincia" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Provincia</label>

                @error('provincia')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
        </div>
        {{--  --}}

        {{-- ROL --}}
        <label for="" class="mb-4 text-lg">Rol</label>

        <div class="flex pt-4">
            <div class="form-check form-check-inline">
              <input class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="rol" id="normal" value="1" checked>
              <label class="form-check-label inline-block text-gray-800" for="normal">Normal</label>
            </div>
            <div class="form-check form-check-inline mx-4">
              <input class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="rol" id="admin" value="2">
              <label class="form-check-label inline-block text-gray-800" for="admin">Admin</label>
            </div>
        </div>

        <div class="mt-10">
            <button type="submit" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-plus"></i> Crear</button>
            <a href="{{ route('users.index') }}" class="bg-orange-500 hover:bg-orange-700 mx-4 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white"><i class="fas fa-backward"></i> Regresar</a>
        </div>
    </div>
</form>
@endsection
