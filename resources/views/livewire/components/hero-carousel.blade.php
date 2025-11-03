<div class="relative bg-gradient-to-br from-amber-50 via-white to-amber-100 overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-amber-200/30 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-amber-300/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-amber-100/40 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="max-w-7xl mx-auto relative">
        <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            {{-- SVG shape for decorative edge with gradient --}}
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-gradient-to-br from-amber-50 to-white transform translate-x-1/2" fill="url(#gradient)" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#fffbeb;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                {{-- Navigation placeholder --}}
            </div>

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <!-- Decorative line -->
                    <div class="inline-block mb-4 animate-fade-in-down">
                        <div class="flex items-center gap-2">
                            <div class="h-px w-12 bg-gradient-to-r from-transparent to-amber-400"></div>
                            <span class="text-amber-700 text-sm font-medium tracking-wider uppercase">Premium Collection</span>
                        </div>
                    </div>

                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline animate-fade-in-up">SELAMAT</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-amber-800 xl:inline animate-fade-in-up animation-delay-200"> BELANJA</span>
                    </h1>
                    
                    <p class="mt-3 text-base text-gray-700 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 animate-fade-in-up animation-delay-400 leading-relaxed">
                        Temukan hijab, tunik, dan busana Muslimah terbaik untuk melengkapi gaya Anda. Kualitas premium dengan harga terjangkau.
                    </p>
                    
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start animate-fade-in-up animation-delay-600">
                        <div class="group relative rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-amber-500 to-amber-700 rounded-xl blur opacity-30 group-hover:opacity-60 transition duration-300"></div>
                            <a href="{{ route('products.catalog') }}" class="relative w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 md:py-4 md:text-lg md:px-10 transition-all duration-300">
                                <span>Shop Now</span>
                                <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="mt-3 sm:mt-0 sm:ml-3 animate-fade-in-up animation-delay-800">
                            <a href="#events" class="w-full flex items-center justify-center px-8 py-3 border border-amber-700 text-base font-medium rounded-xl text-amber-700 bg-white/80 backdrop-blur-sm hover:bg-amber-50 md:py-4 md:text-lg md:px-10 transition-all duration-300 hover:shadow-lg">
                                See Upcoming Events
                            </a>
                        </div>
                    </div>

                    <!-- Trust badges -->
                    <div class="mt-8 flex flex-wrap items-center gap-6 sm:justify-center lg:justify-start animate-fade-in-up animation-delay-1000">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="font-semibold">4.9/5</span>
                            <span>dari 1000+ review</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>100% Original</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Gratis Ongkir</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <div class="relative h-56 w-full sm:h-72 md:h-96 lg:h-full overflow-hidden">
            <!-- Image overlay gradient -->
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-transparent to-amber-50/50 z-10"></div>
            
            <!-- Decorative elements -->
            <div class="absolute top-10 right-10 w-32 h-32 bg-amber-400/20 rounded-full blur-2xl animate-pulse-slow z-0"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-amber-300/20 rounded-full blur-2xl animate-pulse-slow animation-delay-1000 z-0"></div>
            
            <img class="relative h-full w-full object-cover object-center animate-fade-in-right animation-delay-200 z-20" 
                src="{{ asset('images/hero.png') }}" 
                alt="Model wearing hijab">
        </div>
    </div>
    <style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-right {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

@keyframes pulse-slow {
    0%, 100% {
        opacity: 0.3;
        transform: scale(1);
    }
    50% {
        opacity: 0.5;
        transform: scale(1.05);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}

.animate-fade-in-down {
    animation: fade-in-down 0.8s ease-out forwards;
}

.animate-fade-in-right {
    animation: fade-in-right 1s ease-out forwards;
}

.animate-blob {
    animation: blob 7s infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}

.animation-delay-800 {
    animation-delay: 0.8s;
}

.animation-delay-1000 {
    animation-delay: 1s;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
</div>
