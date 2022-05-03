<x-app-layout>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8 lg:mx-24">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($piezas as $pieza)
                    <article class="w-full h-80 bg-cover bg-center @if ($loop->first) lg:col-span-2 @endif"
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
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
