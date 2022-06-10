@extends('layouts.plantillaAdmin')
@section('cabecera')
Listado de Usuarios
@endsection
@section('contenido')
<div class="w-11/12 mx-auto px-2 mt-2">

    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (session('mensaje'))
        <x-alertaInfo>
            {{ session('mensaje') }}
        </x-alertaInfo>
    @endif

    <div class="my-4">
        <a href="{{ route('users.create') }}" class="bg-blue-500 font-bold hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white">
            <i class="fas fa-plus"></i> Crear Usuario</a>
    </div>

    {{-- Alerta de informacion de lo que sea que se haya hecho --}}
    @if (count($users)==0)
        <x-alertaAmarilla>
            No hay usuarios
        </x-alertaAmarilla>

    @else
        <x-estructuraTabla>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col">@sortablelink('id', 'ID')</i>
                        </th>
                        <th scope="col">@sortablelink('name', 'Nombre')</i>
                        </th>
                        <th scope="col">@sortablelink('email', 'Email')</i>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold uppercase tracking-wider">
                            Direccion
                        </th>
                        <th scope="col">@sortablelink('rol', 'Rol')</i>
                        </th>
                        <th scope="col" {{-- colspan="2" --}} class="px-6 py-3 text-center text-xs uppercase tracking-wider">
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('users.show', $user) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-info fa-xs"></i>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $user->getProfilePhotoUrlAttribute() }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm text-center font-medium text-gray-900">
                                            {{ $user->name }}
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-center font-medium text-gray-900">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-center font-medium text-gray-900">
                                    {{ $user->direccion }}
                                </div>
                            </td>
                            {{-- Rol --}}
                            <td class="px-6 py-4 text-center">

                                <a href="{{ route('users.rol', $user) }}" class="cursor-pointer px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                        @if ($user->rol == 1) bg-red-500 @else bg-green-500 @endif">

                                            @if ($user->rol == 1)
                                                Normal
                                            @else
                                                Admin
                                            @endif
                                </a>
                                {{-- <form action="{{ route('users.rol', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="cursor-pointer px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                        @if ($user->rol == 1) bg-red-500 @else bg-green-500 @endif">

                                            @if ($user->rol == 1)
                                                Normal
                                            @else
                                                Admin
                                            @endif

                                    </button>
                                </form> --}}

                            </td>
                            {{--  --}}
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{ route('users.edit', $user) }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-edit"></i></a>
                            </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">

                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button onclick='return confirmar(this.form, "este usuario de nombre {{ $user->name }}")' id="submitBtn" name="submitBtn"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        <i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-estructuraTabla>

    @endif
    <div class="mt-2">
        {{ $users->links() }}
    </div>
</div>
@endsection
