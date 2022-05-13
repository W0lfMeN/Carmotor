<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('index') }}">
                        <x-jet-application-mark />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')" class="hover:bg-red-200">
                        {{ __('Listado de productos') }}
                    </x-jet-nav-link>

                    @auth
                        {{-- Aqui van las opciones en caso de que haya un inicio de sesion cualquera --}}
                        <x-jet-nav-link href="{{ route('userProducts.index') }}" :active="request()->routeIs('userProducts.index')" class="hover:bg-red-200">
                            {{ __('Tienda de Segunda mano') }}
                        </x-jet-nav-link>

                        {{-- Aqui van las opciones en caso de que el usuario sea un admin (rol=2) --}}
                        @if (Auth::user()->rol == 2)
                            <x-jet-nav-link href="{{ route('admin') }}" :active="request()->routeIs('admin')" class="hover:bg-red-200">
                                {{ __('Admin User') }}
                            </x-jet-nav-link>
                        @endif

                    @endauth
                </div>
            </div>

            <div class="flex">

                <div class="shrink-0 flex items-center">
                    <!-- Carrito -->
                    <a href="#" id="botonCarrito" class="text-black font-bold text-lg rounded p-3 mt-2"><i class="fa-solid fa-cart-shopping"></i>&nbsp;Carrito</a>
                </div>

                @if (Route::has('login'))
                    <div class="shrink-0 flex items-center">

                        @auth
                            <!-- Login -->
                            {{-- Cuando está logueado --}}

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative" id="botonUser">
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button id="botonUser"
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-red-300 transition">
                                                &nbsp;&nbsp;<img class="h-9 w-9 rounded-full object-cover"
                                                    src="{{ Auth::user()->profile_photo_url }}"
                                                    alt="{{ Auth::user()->name }}" />&nbsp;
                                                <p class="p-2 font-bold">Mi cuenta</p>&nbsp;
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                    {{ Auth::user()->name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Account') }}
                                        </div>

                                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                            <i class="fa-solid fa-user"></i> {{ __('Profile') }}
                                        </x-jet-dropdown-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                                {{ __('API Tokens') }}
                                            </x-jet-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf

                                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                <i class="fa-solid fa-right-from-bracket"></i> {{ __('Log Out') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        @else
                            {{-- Cuando no Está logueado --}}
                            <!-- No Login -->
                            <div class="ml-3 relative">
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button id="botonUser"
                                            class="flex pt-2 text-xl border-2 border-transparent rounded-lg focus:outline-none focus:border-red-300 transition">
                                            &nbsp;<i class="fa-solid fa-user"></i>&nbsp;&nbsp;<i
                                                class="fa-solid fa-caret-down"></i>&nbsp;
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <!-- Cuadro de informacion -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Iniciar sesion o Registrarse') }}
                                        </div>

                                        <x-jet-dropdown-link href="{{ route('login') }}">
                                            <i class="fa-solid fa-user"></i> {{ __('Login') }}
                                        </x-jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        @if (Route::has('register'))
                                            <x-jet-dropdown-link href="{{ route('register') }}">
                                                <i class="fa-solid fa-right-from-bracket"></i> {{ __('Register') }}
                                            </x-jet-dropdown-link>
                                        @endif

                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        @endauth
                    </div>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')" class="hover:bg-red-200">
                {{ __('Listado de productos') }}
            </x-jet-responsive-nav-link>

            @auth
                {{-- Aqui van las opciones en caso de que haya una sesion cualquiera iniciada --}}
                <x-jet-responsive-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')" class="hover:bg-red-200">
                    {{ __('Tienda de Segunda Mano') }}
                </x-jet-responsive-nav-link>

                {{-- Aqui van las opciones en caso de que el usuario sea un admin (rol=2) --}}
                @if (Auth::user()->rol == 2)
                    <x-jet-responsive-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')" class="hover:bg-red-200">
                        {{ __('Admin User') }}
                    </x-jet-responsive-nav-link>
                @endif
            @endauth

        </div>

        {{-- Div del carrito de compra --}}
        <div>
            <x-jet-responsive-nav-link href="#" class="text-black font-bold border-y border-gray-200" :active="request()->routeIs('#')">
                <p><i class="fa-solid fa-cart-shopping"></i>&nbsp;Carrito</p>
            </x-jet-responsive-nav-link>
        </div>



        @if (Route::has('login'))
            @auth
                {{-- Cuando se está logueado --}}

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                {{ __('API Tokens') }}
                            </x-jet-responsive-nav-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-jet-responsive-nav-link>
                        </form>
                    </div>

                </div> <!-- Responsive Settings Options -->
            @else
                {{-- Cuando no se está logueado --}}
                <div class="pt-4 pb-1 border-t border-gray-200">

                    <div class="flex items-center px-4">

                        <div class="shrink-0 mr-3">
                            <h1><i class="fa-solid fa-user"></i></h1>
                        </div>

                        <div>
                            <div class="font-medium text-base text-gray-800">Iniciar sesion o Registrarse</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-jet-responsive-nav-link>

                        @if (Route::has('register'))
                            <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                {{ __('Register') }}
                            </x-jet-responsive-nav-link>
                        @endif
                    </div>

                </div>
            @endauth
        @endif

    </div> <!-- Responsive Navigation Menu -->
</nav>
