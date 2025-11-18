<div x-data="{ open: false }" class="bg-gradient-to-br from-amber-50 via-[#F8F3E9] to-amber-100 min-h-screen">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-20 w-96 h-96 bg-amber-200/20 rounded-full blur-3xl animate-blob"></div>
        <div
            class="absolute bottom-40 left-20 w-96 h-96 bg-amber-300/15 rounded-full blur-3xl animate-blob animation-delay-2000">
        </div>
    </div>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mobile Filter Button -->
            <div class="bg-transparent lg:hidden mb-6 px-4 sm:px-0 animate-fade-in-down">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-3 border-2 border-amber-700/50 rounded-xl text-gray-800 bg-white/80 backdrop-blur-sm hover:bg-amber-50 hover:border-amber-700 transition-all duration-300 shadow-md hover:shadow-lg group">
                    <span class="font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter & Urutkan
                    </span>
                    <svg class="h-5 w-5 transform transition-transform duration-300 group-hover:scale-110"
                        :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Overlay for mobile -->
                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"
                    @click="open = false" x-cloak></div>

                <!-- Sidebar Filter -->
                <aside :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                    class="fixed inset-y-0 left-0 z-50 w-80 bg-white/95 backdrop-blur-md p-6 overflow-y-auto shadow-2xl transition-transform duration-300 lg:relative lg:z-auto lg:inset-auto lg:w-auto lg:col-span-1 lg:rounded-2xl lg:shadow-xl lg:border lg:border-amber-200/50 lg:block"
                    x-cloak>

                    <!-- Close button for mobile -->
                    <div class="lg:hidden flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Filter</h2>
                        <button @click="open = false" class="p-2 rounded-lg hover:bg-amber-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <h2 class="hidden lg:block text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter
                    </h2>

                    <div class="space-y-8">
                        <!-- Rest of the content remains the same -->
                        <div class="animate-fade-in-up">
                            <label for="sort-by"
                                class="block text-sm font-semibold text-gray-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                Urutkan
                            </label>
                            <select id="sort-by" wire:model.live="sortBy"
                                class="mt-1 block w-full pl-4 pr-10 py-3 text-base border-2 border-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-xl bg-white/50 backdrop-blur-sm hover:border-amber-300 transition-all duration-300 cursor-pointer">
                                <option value="latest">Terbaru</option>
                                <option value="price_asc">Harga Terendah</option>
                                <option value="price_desc">Harga Tertinggi</option>
                            </select>
                        </div>

                        <!-- Colors -->
                        <div class="animate-fade-in-up animation-delay-200">
                            <h3 class="text-sm font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                    </path>
                                </svg>
                                Warna
                            </h3>
                            <div class="mt-3 space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                                @foreach($availableColors as $color)
                                <div class="flex items-center group">
                                    <input id="color-{{ $color->id }}" wire:model.live="selectedColors"
                                        value="{{ $color->id }}" type="checkbox"
                                        class="h-5 w-5 border-2 border-amber-300 rounded-md text-amber-700 focus:ring-amber-500 focus:ring-2 cursor-pointer transition-all duration-200 hover:border-amber-500">
                                    <label for="color-{{ $color->id }}"
                                        class="ml-3 text-sm text-gray-700 cursor-pointer group-hover:text-amber-800 transition-colors duration-200 font-medium">
                                        {{ $color->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="animate-fade-in-up animation-delay-400">
                            <label for="max-price"
                                class="block text-sm font-semibold text-gray-800 mb-2 flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    Harga Maksimal
                                </span>
                                <span class="text-amber-700 font-bold">IDR {{ number_format($maxPrice ?? 500000, 0, ',',
                                    '.') }}</span>
                            </label>
                            <input id="max-price" type="range" min="50000" max="500000" step="10000"
                                wire:model.live="maxPrice"
                                class="w-full h-3 bg-amber-100 rounded-lg appearance-none cursor-pointer accent-amber-700 hover:accent-amber-800 transition-all duration-200"
                                style="background: linear-gradient(to right, #b45309 0%, #b45309 {{ (($maxPrice ?? 500000) - 50000) / (500000 - 50000) * 100 }}%, #fef3c7 {{ (($maxPrice ?? 500000) - 50000) / (500000 - 50000) * 100 }}%, #fef3c7 100%);">
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>IDR 50K</span>
                                <span>IDR 500K</span>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="lg:col-span-3">
                    @if (session()->has('error'))
                    <div class="mb-6 bg-red-50 border-2 border-red-200 text-red-800 px-6 py-4 rounded-xl text-center shadow-lg animate-shake"
                        role="alert">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold">{{ session('error') }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($products as $index => $product)
                        <div class="bg-white/90 backdrop-blur-sm border-2 border-amber-200/50 rounded-2xl p-5 flex flex-col group hover:shadow-2xl hover:border-amber-400 transition-all duration-500 hover:-translate-y-2 animate-fade-in-up"
                            style="animation-delay: {{ $index * 0.1 }}s">
                            <!-- Product Image -->
                            <div
                                class="relative overflow-hidden rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 h-72 mb-4 group-hover:shadow-xl transition-shadow duration-500">
                                @if($product->getFirstMedia('products'))
                                {{ $product->getFirstMedia('products')->img('catalog')->attributes([
                                'class' => 'w-full h-full object-cover transform group-hover:scale-110
                                transition-transform duration-700 ease-out',
                                'alt' => $product->name,
                                'loading' => $index < 3 ? 'eager' : 'lazy',
                                    '300',
                                    'height' => '375'
                                    ]) }}
                                    @else
                                    <img src="https://placehold.co/400x400/f3f4f6/9B7E5C?text=No+Image"
                                        alt="{{ $product->name }}" loading="{{ $index < 3 ? 'eager' : 'lazy' }}"
                                        width="300" height="375"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
                                    @endif


                                    <!-- Hover Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end justify-center pb-4">
                                        <a href="{{ route('products.detail', $product->slug) }}"
                                            class="text-white text-sm font-semibold flex items-center gap-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                            Lihat Detail
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>

                                    <!-- Badge/Tag -->
                                    <div
                                        class="absolute top-3 right-3 bg-amber-700 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                        New
                                    </div>
                            </div>

                            <!-- Product Info -->
                            <div class="flex flex-col flex-grow">
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-amber-800 transition-colors duration-300">
                                    <a href="{{ route('products.detail', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <div class="flex items-center gap-2 mb-3">
                                    <div class="flex items-center">
                                        @for($i = 0; $i < 5; $i++) <svg
                                            class="w-4 h-4 {{ $i < 4 ? 'text-amber-500' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            @endfor
                                    </div>
                                    <span class="text-xs text-gray-500">(4.0)</span>
                                </div>

                                <p class="text-2xl font-bold text-amber-800 mb-4">
                                    IDR {{ number_format($product->base_price, 0, ',', '.') }}
                                </p>

                                <!-- Action Button -->
                                <div class="mt-auto">
                                    <button wire:click="buyNow({{ $product->id }})"
                                        class="w-full bg-gradient-to-r from-amber-600 to-amber-700 text-white py-3 px-4 rounded-xl text-sm font-semibold hover:from-amber-700 hover:to-amber-800 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl flex items-center justify-center gap-2 group/btn">
                                        <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        Beli Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-16 animate-fade-in">
                            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <p class="text-xl text-gray-600 font-semibold">Tidak ada produk yang cocok dengan filter
                                Anda.</p>
                            <p class="text-gray-500 mt-2">Coba ubah filter atau kata kunci pencarian</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 animate-fade-in-up animation-delay-600">
                        {{ $products->links() }}
                    </div>
                </main>
            </div>
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

        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
            opacity: 0;
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out forwards;
        }

        .animate-fade-in {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
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

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #fef3c7;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #b45309;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #92400e;
        }

        /* Line clamp utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>