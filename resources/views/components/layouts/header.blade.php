<header class="bg-[#F8F3E9] shadow-lg">
    {{-- Main Navigation --}}
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}"
                    class="text-2xl font-bold text-gray-900 transition-transform duration-300 hover:scale-105 inline-block">
                    <img src="{{ asset('images/logo.png') }}" alt="SABIMUL Logo" class="h-10">
                </a>
            </div>

            {{-- Menu Links (Desktop) --}}
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ route('home') }}"
                    class="relative font-medium text-[#443937] hover:text-gray-900 transition-colors duration-300 py-2 group {{ request()->routeIs('home') ? 'text-gray-900' : '' }}">
                    Home
                    <span
                        class="absolute bottom-0 left-0 w-full h-0.5 bg-[#443937] transform origin-left transition-transform duration-300 {{ request()->routeIs('home') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('products.catalog') }}"
                    class="relative font-medium text-[#443937] hover:text-gray-900 transition-colors duration-300 py-2 group {{ request()->routeIs('products.*') ? 'text-gray-900' : '' }}">
                    Collections
                    <span
                        class="absolute bottom-0 left-0 w-full h-0.5 bg-[#443937] transform origin-left transition-transform duration-300 {{ request()->routeIs('products.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('about.index') }}"
                    class="relative font-medium text-[#443937] hover:text-gray-900 transition-colors duration-300 py-2 group {{ request()->routeIs('about.*') ? 'text-gray-900' : '' }}">
                    About
                    <span
                        class="absolute bottom-0 left-0 w-full h-0.5 bg-[#443937] transform origin-left transition-transform duration-300 {{ request()->routeIs('about.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>

                <a href="{{ route('contact.index') }}"
                    class="relative font-medium text-[#443937] hover:text-gray-900 transition-colors duration-300 py-2 group {{ request()->routeIs('contact.*') ? 'text-gray-900' : '' }}">
                    Contact
                    <span
                        class="absolute bottom-0 left-0 w-full h-0.5 bg-[#443937] transform origin-left transition-transform duration-300 {{ request()->routeIs('contact.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                </a>
            </div>

            {{-- Functional Icons (Desktop) --}}
            <div class="hidden md:flex md:items-center md:space-x-6">
                <livewire:search-bar />
                <div class="transition-transform duration-200 hover:scale-110">
                    <livewire:components.wishlist-icon />
                </div>
                <div class="transition-transform duration-200 hover:scale-110">
                    <livewire:shopping-cart-icon />
                </div>
                <a href="/profile"
                    class="text-[#443937] hover:text-gray-900 transition-all duration-200 hover:scale-110">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="md:hidden">
                <button class="text-[#443937] hover:text-gray-900 transition-all duration-200 hover:scale-110">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>