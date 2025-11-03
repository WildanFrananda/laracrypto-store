<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sabimul') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            <x-layouts.header />
            <main class="flex-grow">
                {{ $slot }}
            </main>
            <x-layouts.footer />
        </div>
        @stack('scripts')
        <script>
            document.addEventListener('livewire:navigated', () => {});
            window.addEventListener('pageshow', event => {
                if (event.persisted) {
                    window.Livewire.forceRefresh();
                }
            });
        </script>
    </body>
</html>
