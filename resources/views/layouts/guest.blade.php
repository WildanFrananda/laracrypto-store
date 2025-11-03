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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-[#F8F3E9] via-[#EDE4D3] to-[#E8DCC8] relative overflow-hidden">
            {{-- Decorative Background Elements --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                {{-- Top Right Circle --}}
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#443937]/5 rounded-full blur-3xl animate-float"></div>
                
                {{-- Bottom Left Circle --}}
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[#443937]/5 rounded-full blur-3xl animate-float-delayed"></div>
                
                {{-- Center Circle --}}
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/20 rounded-full blur-3xl"></div>
            </div>

            {{-- Content --}}
            <div class="relative z-10">
                {{ $slot }}
            </div>
        </div>

        {{-- Custom Animations --}}
        <style>
            @keyframes float {
                0%, 100% {
                    transform: translateY(0px) translateX(0px);
                }
                50% {
                    transform: translateY(-20px) translateX(10px);
                }
            }
            
            @keyframes float-delayed {
                0%, 100% {
                    transform: translateY(0px) translateX(0px);
                }
                50% {
                    transform: translateY(20px) translateX(-10px);
                }
            }
            
            .animate-float {
                animation: float 8s ease-in-out infinite;
            }
            
            .animate-float-delayed {
                animation: float-delayed 10s ease-in-out infinite;
            }

            /* Smooth gradient animation */
            body {
                background-attachment: fixed;
            }
        </style>
    </body>
</html>