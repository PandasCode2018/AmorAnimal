<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('subhead')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Toastify --}}
    @vite('resources/js/vendors/toastify.js')
    @vite('resources/js/pages/notification.js')
    @vite('resources/css/vendors/toastify.css')

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased overflow-auto">
    <x-banner />
    <div class="mx-auto bg-grey-400" x-data="{
        openSidebar: true,
    }">

        <div class="min-h-screen flex flex-col">
            <x-custom.header />
            <div class="flex flex-1">
                <x-custom.sidebar />
                <main class="bg-white-300 flex-1 p-3">
                    <div class="flex flex-col">
                        {{ $slot }}
                    </div>
                </main>
            </div>
            <footer class="bg-nav-blue text-white p-2 border-t border-light-border text-center">
                <p class="font-bold">&copy; 2024</p>
                <div class="mx-auto font-bold pr-2">Desarrollado por <a href="#" target=" _blank">PandasCode</a>
                </div>
            </footer>
        </div>
    </div>
    @stack('modals')
    @yield('scripts')
    @livewireScripts

</body>

</html>
