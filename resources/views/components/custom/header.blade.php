<header class="bg-gradient-to-b from-[#57457c] to-[#36e4af]  h-16 border-b border-light-border">
    <div class="flex justify-between items-center h-full px-4">
        <!-- Sección del Logo y el Menú -->
        <div class="p-1 inline-flex items-center">
            <i class="fas fa-bars text-white text-2xl pr-2 cursor-pointer" x-on:click="openSidebar= !openSidebar"></i>
        </div>

        <!-- Sección del Perfil -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            @auth
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_path ? Storage::url(Auth::user()->profile_photo_path) : asset('img_sistema/perfil.png') }}">
                            @endauth
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Configuración') }}
                        </div>
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</header>
