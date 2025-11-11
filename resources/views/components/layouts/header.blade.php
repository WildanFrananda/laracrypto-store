<header x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = window.pageYOffset > 20"
    :class="scrolled ? 'shadow-2xl' : 'shadow-lg'"
    class="bg-gradient-to-r from-[#F8F3E9] via-[#FCF8F0] to-[#F8F3E9] sticky top-0 z-50 transition-all duration-300 backdrop-blur-sm">

    {{-- Main Navigation --}}
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            {{-- Logo --}}
            <div class="flex-shrink-0 animate-[fadeInLeft_0.6s_ease-out]">
                <a href="{{ route('home') }}" class="relative group inline-block">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-lg opacity-0 group-hover:opacity-20 blur transition-opacity duration-300">
                    </div>
                    <img src="{{ asset('images/logo.png') }}" alt="SABIMUL Logo"
                        class="h-12 relative transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-2">
                </a>
            </div>

            {{-- Menu Links (Desktop) --}}
            <div
                class="hidden md:flex md:items-center md:space-x-2 lg:space-x-4 animate-[fadeInDown_0.6s_ease-out_0.2s_both]">
                <a href="{{ route('home') }}"
                    class="relative px-4 py-2 font-semibold text-[#443937] transition-all duration-300 group overflow-hidden rounded-lg {{ request()->routeIs('home') ? 'text-[#CEA87C]' : 'hover:text-[#CEA87C]' }}">
                    <span class="relative z-10 flex items-center">
                        <svg class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:scale-110"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Home
                    </span>
                    <span
                        class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] transform origin-left transition-transform duration-300 rounded-full {{ request()->routeIs('home') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-[#CEA87C]/5 to-[#9B7E5C]/5 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                </a>

                <a href="{{ route('products.catalog') }}"
                    class="relative px-4 py-2 font-semibold text-[#443937] transition-all duration-300 group overflow-hidden rounded-lg {{ request()->routeIs('products.*') ? 'text-[#CEA87C]' : 'hover:text-[#CEA87C]' }}">
                    <span class="relative z-10 flex items-center">
                        <svg class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:scale-110"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        Collections
                    </span>
                    <span
                        class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] transform origin-left transition-transform duration-300 rounded-full {{ request()->routeIs('products.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-[#CEA87C]/5 to-[#9B7E5C]/5 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                </a>

                <a href="{{ route('about.index') }}"
                    class="relative px-4 py-2 font-semibold text-[#443937] transition-all duration-300 group overflow-hidden rounded-lg {{ request()->routeIs('about.*') ? 'text-[#CEA87C]' : 'hover:text-[#CEA87C]' }}">
                    <span class="relative z-10 flex items-center">
                        <svg class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:scale-110"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        About
                    </span>
                    <span
                        class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] transform origin-left transition-transform duration-300 rounded-full {{ request()->routeIs('about.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-[#CEA87C]/5 to-[#9B7E5C]/5 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                </a>

                <a href="{{ route('contact.index') }}"
                    class="relative px-4 py-2 font-semibold text-[#443937] transition-all duration-300 group overflow-hidden rounded-lg {{ request()->routeIs('contact.*') ? 'text-[#CEA87C]' : 'hover:text-[#CEA87C]' }}">
                    <span class="relative z-10 flex items-center">
                        <svg class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:scale-110"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        Contact
                    </span>
                    <span
                        class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] transform origin-left transition-transform duration-300 rounded-full {{ request()->routeIs('contact.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-[#CEA87C]/5 to-[#9B7E5C]/5 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></span>
                </a>
            </div>

            {{-- Functional Icons (Desktop) --}}
            <div class="hidden md:flex md:items-center md:space-x-4 animate-[fadeInRight_0.6s_ease-out_0.2s_both]">
                <div class="transform transition-all duration-300 hover:scale-110">
                    <livewire:search-bar />
                </div>

                <div class="relative group">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-full opacity-0 group-hover:opacity-20 blur transition-opacity duration-300">
                    </div>
                    <div class="relative transform transition-all duration-300 hover:scale-110 hover:rotate-12">
                        <livewire:components.wishlist-icon />
                    </div>
                </div>

                <div class="relative group">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-full opacity-0 group-hover:opacity-20 blur transition-opacity duration-300">
                    </div>
                    <div class="relative transform transition-all duration-300 hover:scale-110 hover:-rotate-12">
                        <livewire:shopping-cart-icon />
                    </div>
                </div>

                <a href="/profile"
                    class="relative group p-2 rounded-full transition-all duration-300 hover:bg-gradient-to-r hover:from-[#CEA87C]/10 hover:to-[#9B7E5C]/10">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-full opacity-0 group-hover:opacity-20 blur transition-opacity duration-300">
                    </div>
                    <svg class="relative h-6 w-6 text-[#443937] group-hover:text-[#CEA87C] transform transition-all duration-300 group-hover:scale-110"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="md:hidden animate-[fadeInRight_0.6s_ease-out]">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="relative group p-2 text-[#443937] hover:text-[#CEA87C] transition-all duration-300">
                    <div
                        class="absolute -inset-2 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-lg opacity-0 group-hover:opacity-20 blur transition-opacity duration-300">
                    </div>
                    <svg class="relative h-6 w-6 transform transition-transform duration-300"
                        :class="mobileMenuOpen ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-4"
        class="md:hidden border-t border-[#CEA87C]/20 bg-gradient-to-b from-white to-[#FCF8F0]" style="display: none;">
        <div class="px-4 pt-4 pb-6 space-y-3">
            {{-- Mobile Menu Links --}}
            <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                class="flex items-center px-4 py-3 rounded-xl font-semibold text-[#443937] transition-all duration-300 {{ request()->routeIs('home') ? 'bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white shadow-lg' : 'hover:bg-gradient-to-r hover:from-[#CEA87C]/10 hover:to-[#9B7E5C]/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Home
            </a>

            <a href="{{ route('products.catalog') }}" @click="mobileMenuOpen = false"
                class="flex items-center px-4 py-3 rounded-xl font-semibold text-[#443937] transition-all duration-300 {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white shadow-lg' : 'hover:bg-gradient-to-r hover:from-[#CEA87C]/10 hover:to-[#9B7E5C]/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                </svg>
                Collections
            </a>

            <a href="{{ route('about.index') }}" @click="mobileMenuOpen = false"
                class="flex items-center px-4 py-3 rounded-xl font-semibold text-[#443937] transition-all duration-300 {{ request()->routeIs('about.*') ? 'bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white shadow-lg' : 'hover:bg-gradient-to-r hover:from-[#CEA87C]/10 hover:to-[#9B7E5C]/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                About
            </a>

            <a href="{{ route('contact.index') }}" @click="mobileMenuOpen = false"
                class="flex items-center px-4 py-3 rounded-xl font-semibold text-[#443937] transition-all duration-300 {{ request()->routeIs('contact.*') ? 'bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white shadow-lg' : 'hover:bg-gradient-to-r hover:from-[#CEA87C]/10 hover:to-[#9B7E5C]/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                Contact
            </a>

            {{-- Mobile Icons --}}
            <div class="pt-4 mt-4 border-t border-[#CEA87C]/20 flex items-center justify-around">
                <div class="transform transition-all duration-300 hover:scale-110">
                    <livewire:components.wishlist-icon />
                </div>
                <div class="transform transition-all duration-300 hover:scale-110">
                    <livewire:shopping-cart-icon />
                </div>
                <a href="/profile"
                    class="p-2 rounded-full hover:bg-gradient-to-r hover:from-[#CEA87C]/10 hover:to-[#9B7E5C]/10 transition-all duration-300">
                    <svg class="h-6 w-6 text-[#443937]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <style>
        [x-cloak] {
            display: none !important;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</header>