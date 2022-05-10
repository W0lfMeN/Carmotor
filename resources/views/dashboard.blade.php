<x-app-layout>

    <div class="py-10">
        <div class="sm:px-6 md:mx-24 lg:px-8 lg:mx-48">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($piezas as $pieza)
                    {{--  --}}

                    <div class="rounded overflow-hidden mb-5 shadow-lg hover:shadow-2xl transform transition duration-500 hover:scale-110 ease-in-out">
                        <img class="w-full" src="{{Storage::url($pieza->imagen)}}" alt="{{$pieza->nombre}}">
                        <div class="px-6 py-4">
                          <div class="font-bold text-xl mb-2">{{$pieza->nombre}}</div>
                          <p class="font-bold text-xl text-center">
                            {{$pieza->precio}}&nbsp;€
                          </p>
                        </div>
                        <div class="px-2 mt-2 font-bold items-center">
                            {{$pieza->tipo}}
                        </div>
                        <div class="px-6 pt-4 pb-2">
                          @foreach ($pieza->brands as $brand)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 mt-1">{{$brand->nombre}}</span>
                          @endforeach
                        </div>
                        @if ($pieza->cantidad <= 3)
                            <div class="px-2 my-2 font-bold text-red-800 items-center">
                                <h5>Solo quedan {{$pieza->cantidad}} en stock!!</h5>
                            </div>
                        @endif


                      </div>

                    {{--  --}}

                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

{{-- <article class="w-full h-80 bg-cover bg-center @if ($loop->first) lg:col-span-2 @endif"
                    style="background-image: url({{Storage::url($pieza->imagen)}})">
                        <div class="flex flex-col justify-center w-full h-full">
                            <div>
                                <h1 class="px-2 text-xl text-white font-bold">{{$pieza->nombre}}</h1>
                            </div>
                            <div class="px-2 mt-2 font-bold text-gray-200 items-center">
                                ({{$pieza->tipo}})
                            </div>
                            @if ($pieza->cantidad <= 3)
                                <div class="px-2 mt-2 font-bold text-red-800 items-center">
                                    <h5>Solo quedan {{$pieza->cantidad}} en stock!!</h5>
                                </div>
                            @endif
                        </div>
                    </article> --}}
