<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- titulo dinamico --}}
    @yield('subhead')


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
        {{--  @livewire('navigation-menu') --}}
        <div class="min-h-screen flex flex-col">
            <!--Header -->
            <x-custom.header />

            <div class="flex flex-1">
                <!--Sidebar-->
                <x-custom.sidelBar />
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
