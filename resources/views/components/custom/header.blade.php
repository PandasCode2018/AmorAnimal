<header class="bg-nav-blue h-16  border-b border-light-border">
    <div class="flex justify-between items-center h-full px-4">
        <!-- Sección del Logo y el Menú -->
        <div class="p-1 inline-flex items-center">
            <i class="fas fa-bars text-white text-2xl pr-2 cursor-pointer" x-on:click="openSidebar= !openSidebar"></i>
            {{--  <h1 class="text-white text-2xl font-bold">Logo</h1> --}}
        </div>

        <!-- Sección del Perfil -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/e40b6ea6361a1abe28f32e7910f63b66/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg"
                                alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Configuración') }}
                        </div>
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __(Auth::user()->name) }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __(Auth::user()->company->name_company) }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('consultation.index') }}">
                            {{ __('Manuales') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Soporte') }}
                        </x-dropdown-link>
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

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</header>
