<div class="bg-gradient-to-b from-[#F8F3E9] via-[#FCF8F0] to-[#F8F3E9] py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center animate-[fadeInDown_0.8s_ease-out]">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="h-1 w-12 bg-gradient-to-r from-transparent via-[#CEA87C] to-transparent rounded-full"></div>
                <svg class="w-8 h-8 mx-4 text-[#CEA87C]" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                </svg>
                <div class="h-1 w-12 bg-gradient-to-r from-[#CEA87C] via-transparent to-transparent rounded-full"></div>
            </div>

            <h2
                class="text-4xl sm:text-5xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-[#443937] via-[#CEA87C] to-[#443937] mb-6">
                Our Categories
            </h2>

            {{-- <div class="mt-6 flex justify-center">
                <div class="relative w-64">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div
                            class="w-full border-t-2 border-gradient-to-r from-transparent via-[#CEA87C] to-transparent">
                        </div>
                    </div>
                    <div class="relative flex justify-center">
                        <img class="h-8 drop-shadow-lg animate-[pulse_3s_ease-in-out_infinite]"
                            src="{{ asset('images/separator.svg') }}" alt="Separator">
                    </div>
                </div>
            </div> --}}

            <p class="mt-6 text-lg text-[#443937]/80 max-w-2xl mx-auto leading-relaxed">
                Discover our curated collection across different categories
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="mt-16 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach($categories as $index => $category)
            <div x-data="{ open: false }" class="group animate-[fadeInUp_0.6s_ease-out_{{$index * 0.1}}s_both]">
                <button @click="open = true"
                    class="relative block overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 w-full text-left">
                    <!-- Image Container -->
                    <div class="relative aspect-[3/4] overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                        @if($category->getFirstMedia('categories'))
                        {{ $category->getFirstMedia('categories')->img()->attributes([
                        'class' => 'w-full h-full object-cover transition-all duration-700 group-hover:scale-110
                        group-hover:rotate-2'
                        ]) }}
                        @else
                        <img src="https://placehold.co/400x500/f3f4f6/333333?text={{ urlencode($category->name) }}"
                            alt="{{ $category->name }}"
                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-2">
                        @endif

                        <!-- Gradient Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500">
                        </div>

                        <!-- Animated Border -->
                        <div
                            class="absolute inset-0 border-4 border-transparent group-hover:border-[#CEA87C]/50 rounded-2xl transition-all duration-500">
                        </div>

                        <!-- Shine Effect -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 translate-x-[-200%] group-hover:translate-x-[200%] transition-transform duration-1000">
                            </div>
                        </div>
                    </div>

                    <!-- Content Overlay -->
                    <div class="absolute inset-x-0 bottom-0 p-5 transform transition-all duration-500">
                        <div class="transform transition-all duration-500 group-hover:translate-y-[-8px]">
                            <h3 class="text-white text-xl font-bold mb-2 drop-shadow-lg">
                                {{ $category->name }}
                            </h3>

                            <!-- Animated Underline -->
                            <div
                                class="h-1 w-0 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-full group-hover:w-full transition-all duration-500">
                            </div>

                            <!-- Explore Button (appears on hover) -->
                            <div
                                class="mt-4 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                <span
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white text-sm font-semibold rounded-full shadow-lg">
                                    Explore
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Corner Accent -->
                    <div
                        class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-0 group-hover:scale-100">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </button>

                <!-- Modal -->
                <div x-show="open" x-cloak @click.away="open = false"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">

                    <!-- Background Overlay -->
                    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>

                    <!-- Modal Content -->
                    <div class="flex min-h-full items-center justify-center p-4">
                        <div @click.stop x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-10"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-10"
                            class="relative bg-gradient-to-br from-white to-[#FCF8F0] rounded-3xl shadow-2xl max-w-4xl w-full overflow-hidden">

                            <!-- Close Button -->
                            <button @click="open = false"
                                class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110 group">
                                <svg class="w-6 h-6 text-[#443937] group-hover:rotate-90 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="grid md:grid-cols-2 gap-0">
                                <!-- Image Section -->
                                <div class="relative h-64 md:h-auto">
                                    @if($category->getFirstMedia('categories'))
                                    {{ $category->getFirstMedia('categories')->img()->attributes([
                                    'class' => 'w-full h-full object-cover'
                                    ]) }}
                                    @else
                                    <img src="https://placehold.co/600x800/f3f4f6/333333?text={{ urlencode($category->name) }}"
                                        alt="{{ $category->name }}" class="w-full h-full object-cover">
                                    @endif

                                    <!-- Gradient Overlay on Image -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                                    <!-- Category Badge -->
                                    <div class="absolute bottom-4 left-4">
                                        <span
                                            class="inline-flex items-center px-4 py-2 bg-white/90 backdrop-blur-sm text-[#443937] font-bold rounded-full shadow-lg">
                                            <svg class="w-5 h-5 mr-2 text-[#CEA87C]" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                            </svg>
                                            Category
                                        </span>
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="p-8 md:p-10 flex flex-col justify-between">
                                    <div>
                                        <!-- Title -->
                                        <h3
                                            class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#443937] to-[#CEA87C] mb-4">
                                            {{ $category->name }}
                                        </h3>

                                        <!-- Decorative Line -->
                                        <div
                                            class="h-1 w-20 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] rounded-full mb-6">
                                        </div>

                                        <!-- Description -->
                                        <p class="text-[#443937]/80 text-lg leading-relaxed mb-6">
                                            Discover our exclusive collection of {{ strtolower($category->name) }}
                                            products. Each item is carefully curated to bring you the finest quality and
                                            unique designs.
                                        </p>

                                        <!-- Features List -->
                                        <div class="space-y-3 mb-8">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                                <span class="text-[#443937]">Premium Quality Products</span>
                                            </div>
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                                <span class="text-[#443937]">Curated Selection</span>
                                            </div>
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                                <span class="text-[#443937]">Unique Designs</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="space-y-3">
                                        <a href="#"
                                            class="group w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                            <span>Browse {{ $category->name }}</span>
                                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>

                                        <button @click="open = false"
                                            class="w-full px-6 py-3 bg-white border-2 border-[#CEA87C] text-[#443937] font-semibold rounded-xl hover:bg-[#CEA87C] hover:text-white transition-all duration-300">
                                            Maybe Later
                                        </button>
                                    </div>

                                    <!-- Stats -->
                                    <div class="mt-8 pt-6 border-t border-gray-200 grid grid-cols-3 gap-4">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-[#CEA87C]">50+</div>
                                            <div class="text-xs text-[#443937]/60">Products</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-[#CEA87C]">★ 4.8</div>
                                            <div class="text-xs text-[#443937]/60">Rating</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-[#CEA87C]">1.2k</div>
                                            <div class="text-xs text-[#443937]/60">Reviews</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="mt-16 text-center animate-[fadeInUp_0.8s_ease-out_0.5s_both]">
            <a href="#"
                class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#CEA87C] via-[#9B7E5C] to-[#CEA87C] bg-size-200 bg-pos-0 hover:bg-pos-100 text-white font-bold text-lg rounded-full shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-500">
                <span>View All Categories</span>
                <svg class="w-6 h-6 ml-3 transform group-hover:translate-x-2 transition-transform duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
    <style>
        [x-cloak] {
            display: none !important;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        .bg-size-200 {
            background-size: 200% 100%;
        }

        .bg-pos-0 {
            background-position: 0% 0%;
        }

        .bg-pos-100 {
            background-position: 100% 0%;
        }
    </style>
</div>