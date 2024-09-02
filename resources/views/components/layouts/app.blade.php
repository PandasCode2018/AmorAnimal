<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--  titulo dinamico --}}
    @yield('subhead')

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('img_sistema/panda-code.ico') }}" type="image/x-icon" sizes="96x96">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Toastify --}}
    @vite('resources/js/vendors/toastify.js')
    {{--  @vite('resources/js/pages/notification.js') --}}
    @vite('resources/css/vendors/toastify.css')

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased overflow-auto bg-[#e8f7f4]">
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
            <footer
                class="bg-gradient-to-b from-[#57457c] to-[#36e4af] text-white p-2 border-t border-light-border text-center">
                <p class="font-bold">&copy; 2024</p>
                <div class="mx-auto font-bold pr-2">Desarrollado por <a href="https://pandascode.com/"
                        target="_blank">PandasCode</a>
                </div>
            </footer>
        </div>
    </div>

    <!-- Botón de WhatsApp -->
    <a href="https://wa.me/573234030976?text=Hola%2C%20me%20comunico%20por%20la%20plataforma%20Amor%20Animal."
        target="_blank"
        class="hidden sm:flex whatsapp-button fixed bottom-4 right-4 bg-green-500 hover:bg-green-600 text-white rounded-full w-16 h-16 items-center justify-center shadow-lg">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YNW50WQ3RG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-YNW50WQ3RG');
    </script>



    @stack('modals')
    @yield('scripts')
    @livewireScripts
</body>


</html>
