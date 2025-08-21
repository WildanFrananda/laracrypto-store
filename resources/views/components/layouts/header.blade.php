<header class="bg-white shadow-sm">
    {{-- Top Bar --}}
    <div class="bg-gray-100 py-2 text-xs text-gray-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <span>Contact: (62) 812-3456-7890 | support@sabimul.id</span>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Social Media Icons --}}
                <a href="#" class="hover:text-gray-900">FB</a>
                <a href="#" class="hover:text-gray-900">TW</a>
                <a href="#" class="hover:text-gray-900">IG</a>
            </div>
        </div>
    </div>

    {{-- Main Navigation --}}
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">SABIMUL</a>
            </div>

            {{-- Menu Links (Desktop) --}}
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ route('home') }}" class="font-medium text-gray-500 hover:text-gray-900">Home</a>
                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Collections</a>
                <a href="{{ route('products.catalog') }}" class="font-medium text-gray-500 hover:text-gray-900">Categories</a>
                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">About</a>
                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Contact</a>
            </div>

            {{-- Functional Icons (Desktop) --}}
            <div class="hidden md:flex md:items-center md:space-x-6">
                <button class="text-gray-500 hover:text-gray-900">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
                <livewire:components.wishlist-icon />
                <livewire:shopping-cart-icon />
                <a href="/profile" class="text-gray-500 hover:text-gray-900">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </a>
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="md:hidden">
                {{-- Logic for mobile menu will be added later --}}
                <button class="text-gray-500 hover:text-gray-900">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                </button>
            </div>
        </div>
    </nav>
</header>
