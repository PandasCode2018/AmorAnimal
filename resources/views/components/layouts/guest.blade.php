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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased overflow-auto">
    <div class="mx-auto bg-grey-400">
        <div class="min-h-screen flex flex-col">
            <main class="bg-white-300 flex-1">
                <div class="flex flex-col">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>
