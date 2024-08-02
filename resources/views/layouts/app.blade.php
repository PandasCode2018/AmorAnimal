<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased overflow-hidden">
    <x-banner />

    <div class="mx-auto bg-grey-400">
        {{--      @livewire('navigation-menu') --}}
        <div class="min-h-screen flex flex-col">

            <!--Header -->
            <header class="bg-nav h-16">
                <div class="flex justify-between items-center h-full px-4">
                    <!-- Sección del Logo y el Menú -->
                    <div class="p-1 inline-flex items-center">
                        <!-- Icono de Menú -->
                        <i class="fas fa-bars text-white text-2xl pr-2 cursor-pointer" onclick="sidebarToggle()"></i>
                        <!-- Logo -->
                        <h1 class="text-white text-2xl font-bold">Logo</h1>
                    </div>

                    <!-- Sección del Perfil -->
                    <div class="p-1 flex items-center space-x-4">
                        <!-- Imagen de Perfil -->
                        <img onclick="profileToggle()" class="inline-block h-10 w-10 rounded-full cursor-pointer"
                            src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="Profile Picture">

                        <!-- Nombre de Usuario -->
                        <a href="#" onclick="profileToggle()"
                            class="text-white text-lg no-underline hidden md:block lg:block">Adam Wathan</a>

                        <!-- Dropdown del Perfil -->
                        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute mt-12 right-0">
                            <ul class="list-reset">
                                <li><a href="#"
                                        class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My
                                        account</a></li>
                                <li><a href="#"
                                        class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a>
                                </li>
                                <li>
                                    <hr class="border-t mx-2 border-grey-light">
                                </li>
                                <li><a href="#"
                                        class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!--Header-->
            <div class="flex flex-1">

                <!--Sidebar-->
                <aside id="sidebar"
                    class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

                    <ul class="list-reset flex flex-col">

                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="index.html"
                                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-user mr-2"></i>
                                Usuario
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="index.html"
                                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-user-tag mr-2"></i>
                                Roles
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="index.html"
                                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-users mr-2"></i>
                                Responsable
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="index.html"
                                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-paw mr-2"></i>
                                Animales
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="index.html"
                                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-search mr-2"></i>
                                Consulta
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="index.html"
                                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-file-alt mr-2"></i>
                                Reportes
                            </a>
                        </li>
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <a href="index.html"
                                class="flex items-center font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                                <i class="fas fa-book mr-2"></i>
                                Manuales
                            </a>
                        </li>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <main class="bg-white-300 flex-1 p-3 overflow-hidden">
                    <div class="flex flex-col">
                        {{ $slot }}
                    </div>
                </main>
            </div>
            <footer class="bg-grey-darkest text-white p-2 ">
                <div class="flex flex-1 mx-auto">&copy; 2024</div>
                <div class="flex flex-1 mx-auto">Desarrollado por : <a href="https://themewagon.com/" target=" _blank">
                        jhon dow</a></div>
            </footer>
        </div>

    </div>

    @stack('modals')

    @livewireScripts


</body>

</html>
