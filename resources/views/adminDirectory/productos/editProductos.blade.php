@extends('layouts.plantillaAdmin')
@section('cabecera')
Editando el producto de nombre "{{$product->nombre}}" con ID: {{$product->id}}
@endsection
@section('contenido')
<form action="{{route('products.update', $product)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="py-4 px-2 w-3/4 mx-auto border-black border-2 rounded-lg">

        {{-- Nombre del producto --}}
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="nombre" id="nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{$product->nombre}}" />
            <label for="nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
            @error('nombre')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        {{--  --}}

        {{-- Descripcion --}}
        <div class="relative z-0 w-full mb-6 group">
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripcion</label>
            <textarea id="descripcion" name="descripcion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{$product->descripcion}}</textarea>

            @error('descripcion')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        {{--  --}}

        {{-- Precio y cantidad --}}
        <div class="grid xl:grid-cols-2 xl:gap-6 pt-4">
            {{-- Precio --}}
            <div class="relative z-0 w-full mb-6 group">
                <input type="number" step="any" name="precio" id="precio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{$product->precio}}" />
                <label for="precio" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio (€)</label>

                @error('precio')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}

            {{-- Cantidad --}}
            <div class="relative z-0 w-full mb-6 group">
                <input type="number" name="cantidad" id="cantidad" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{$product->cantidad}}"  />
                <label for="cantidad" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Unidades disponibles</label>

                @error('cantidad')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}

            {{-- Tipo de producto --}}
            <div class="relative z-0 w-full mb-6 group">
                <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900">Tipo de producto</label>
                <select name="tipo"
                    class="py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full  sm:text-sm border-gray-300 rounded-md">
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo }}" @if($tipo == $product->tipo) selected @endif>{{ $tipo }}</option>
                    @endforeach
                </select>
                @error('tipos')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}

            {{-- fecha_venta --}}
            <div class="relative">
                <br>
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input datepicker datepicker-autohide datepicker-format="dd/mm/yyyy" value="{{ \Carbon\Carbon::parse($product->fecha_venta)->format('d-m-Y') }}" name="fecha_venta" id="fecha_venta" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 " placeholder="Select date">
                @error('fecha_venta')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}
        </div>
        {{--  --}}

        {{-- Marcas compatibles --}}
        <div class="relative">
            <p class="block text-sm font-medium text-gray-700 mb-2">Marcas complatibles</p>
            @foreach ($marcas as $marca)
                &nbsp;<label class="font-semibold" for="{{ $marca->id }}">
                    <input type="checkbox" id="{{ $marca->id }}" name="marcas[]" value="{{ $marca->id }}" @if(in_array($marca->id, $arrayMarcas)) checked  @endif class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                    {{ $marca->nombre }}

            @endforeach
            @error('marcas')
                <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
            @enderror
        </div>
        {{--  --}}

        {{-- Imagen --}}
        <div class="grid xl:grid-cols-3 xl:gap-2 pt-4">
            {{-- Imagen 1 --}}
            <div class="relative w-full z-0 mb-6 group" >
                <label class="block mb-2 text-sm font-medium text-gray-900" for="imagen">Subir imagen (obligatoria)</label>
                <input name="imagen" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="imagen" id="imagen" type="file">
                @error('imagen')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}

            {{-- Imagen2 --}}
            <div class="relative z-0 w-full mb-6 group" hidden id="img1">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="imagen1">Subir imagen (opcional)</label>
                <input name="imagen1" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="imagen1" id="imagen1" type="file">
                @error('imagen1')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}

            {{-- Boton de imagen 2 --}}
            <div class="relative z-0 w-full mb-6 group" id="divImg1">
                <label for="btnImg1" class="block mb-2 text-sm font-medium text-gray-900">&nbsp;</label>
                <button type="button" id="btnImg1" name="btnImg1" class="bg-blue-500 hover:bg-blue-700 text-white mx-4 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-plus"></i> Añadir imagen</button>
            </div>
            {{--  --}}


            {{-- Imagen 3 --}}
            <div class="relative z-0 w-full mb-6 group" hidden id="img2" >
                <label class="block mb-2 text-sm font-medium text-gray-900" for="imagen2">Subir imagen (opcional)</label>
                <input name="imagen2" id="imagen2" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="imagen2" type="file">
                @error('imagen2')
                    <p class="text-sm text-orange-900 mt-1">*** {{ $message }}</p>
                @enderror
            </div>
            {{--  --}}

            {{-- Boton imagen 3 --}}
            <div class="relative z-0 w-full mb-6 group" id="divImg2">
                <label for="btnImg2" class="block mb-2 text-sm font-medium text-gray-900">&nbsp;</label>
                <button type="button" id="btnImg2" name="btnImg2" class="bg-blue-500 hover:bg-blue-700 mx-4 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white"><i class="fas fa-plus"></i> Añadir imagen</button>
            </div>
            {{--  --}}

            {{-- Previews --}}
            <div>
                <img src="{{Storage::url($product->imagen)}}" class="bg-cover bg-center" id="img">
            </div>

            <div>
                <img src="@isset($product->imagen1) {{Storage::url($product->imagen1)}} @endisset" class="bg-cover bg-center" id="previewImg1">
            </div>

            <div>
                <img src="@isset($product->imagen2) {{Storage::url($product->imagen2)}} @endisset" class="bg-cover bg-center" id="previewImg2">
            </div>
            {{--  --}}

        </div>
        {{--  --}}

        <div class="mt-10">
            <button type="submit" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fa-solid fa-upload"></i> Actualizar</button>
            <a href="{{ route('products.index') }}" class="bg-orange-500 hover:bg-orange-700 mx-4 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white"><i class="fas fa-backward"></i> Regresar</a>
        </div>
    </div>
</form>

{{-- <script>
    //Cambiar imagen
    document.getElementById("imagen").addEventListener('change', cambiarImagen);
    document.getElementById("imagen1").addEventListener('change', cambiarImagen);
    document.getElementById("imagen2").addEventListener('change', cambiarImagen);

    function cambiarImagen(event){
        /* Averiguamos que boton se ha pulsado */

        var boton=event.target.getAttribute('id'); //Esto obtiene el id del boton que se ha pulsado
        var id;
        switch(boton){
            case "imagen1":
                id="img1";
                break;
            case "imagen2":
                id="img2";
                break;

            default:
                id="img";
                break;
        }
        /* console.log(mensaje+" => "+boton); */

        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload=(event)=>{
            document.getElementById(id).setAttribute('src', event.target.result)
        };
        reader.readAsDataURL(file);
    }
</script> --}}
@endsection
