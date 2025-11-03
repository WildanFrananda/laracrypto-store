<div class="bg-gradient-to-b from-[#F8F3E9] to-[#FAF6EE] py-12 sm:py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with fade-in animation -->
        <div class="text-center animate-fade-in">
            <h2 class="text-3xl font-bold tracking-tight text-[#414141] sm:text-4xl mb-2 relative inline-block">
                Best Seller
                <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#9B7E5C] to-transparent"></span>
            </h2>
            <div class="mt-6 flex justify-center">
                <div class="relative w-32">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <img class="text-[#414141] animate-fade-in-delayed" src="{{ asset('images/separator.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <p class="mt-4 text-md text-[#414141] animate-fade-in-more-delayed">Top selling products</p>
        </div>

        <!-- Alert Messages with slide-down animation -->
        @if (session()->has('message'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md text-center shadow-md animate-slide-down" role="alert">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('message') }}
                </span>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md text-center shadow-md animate-slide-down" role="alert">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </span>
            </div>
        @endif

        <!-- Products Grid with staggered animation -->
        <div class="mt-10 flex flex-wrap justify-center gap-6">
            @forelse($bestSellers as $index => $item)
                @php($product = $item->variant->product)
                <div class="group w-full max-w-xs sm:max-w-none sm:w-64 product-card" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="relative w-full h-80 overflow-hidden bg-gray-200">
                            <img src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                class="h-full w-full object-cover object-center transform group-hover:scale-110 transition-transform duration-700 ease-out">
                            
                            <!-- Gradient Overlay on Hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <!-- Action Buttons with slide-in animation -->
                        <div class="absolute top-3 right-3 flex flex-col space-y-2 translate-x-16 group-hover:translate-x-0 transition-transform duration-300">
                            <div class="bg-white rounded-full shadow-lg hover:shadow-xl hover:bg-[#9B7E5C] hover:scale-110 transition-all duration-300 group/wishlist">
                                <livewire:components.wishlist-button :product="$product" :key="'bestseller-wishlist-'.$product->id" />
                            </div>
                            <button wire:click="addToCart({{ $product->id }})" 
                                class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-lg hover:shadow-xl hover:bg-[#9B7E5C] hover:scale-110 transition-all duration-300 group/cart">
                                <svg class="h-5 w-5 text-[#414141] group-hover/cart:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                            <button wire:click="quickView({{ $product->id }})" 
                                class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-lg hover:shadow-xl hover:bg-[#9B7E5C] hover:scale-110 transition-all duration-300 group/view">
                                <svg class="h-5 w-5 text-[#414141] group-hover/view:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Sale Badge (optional) -->
                        <div class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg animate-pulse-slow">
                            HOT
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="mt-4 text-center bg-white p-4 rounded-lg shadow-md group-hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-md font-semibold text-[#414141] hover:text-[#9B7E5C] transition-colors duration-300">
                            <a href="{{ route('products.detail', $product->slug) }}" class="line-clamp-2">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="mt-2 text-lg font-bold text-[#9B7E5C]">IDR {{ number_format($product->base_price, 2, ',', '.') }}</p>
                        <button wire:click="buyNow({{ $product->id }})" 
                            class="mt-4 w-full bg-gradient-to-r from-[#9B7E5C] to-[#B8956A] text-white py-2 px-4 rounded-lg hover:from-[#8A6D4B] hover:to-[#9B7E5C] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg font-medium">
                            Buy now
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 animate-fade-in">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="mt-4 text-lg text-[#414141]">No best selling product available.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Modal Quick View with enhanced animation --}}
    @if($showQuickViewModal && $quickViewProduct)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm animate-fade-in-fast" 
        wire:click.self="closeQuickViewModal">
        <div class="bg-gradient-to-br from-[#F8F3E9] to-[#FAF6EE] rounded-2xl shadow-2xl p-8 w-full max-w-3xl m-4 grid grid-cols-1 md:grid-cols-2 gap-6 animate-scale-in relative">
            <!-- Close Button -->
            <button type="button" wire:click="closeQuickViewModal" 
                class="absolute -top-2 -right-2 w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-lg hover:bg-red-500 hover:text-white transition-all duration-300 z-10 border-2 border-gray-200">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="w-full h-80 bg-gray-200 rounded-xl overflow-hidden shadow-lg">
                <img src="{{ $quickViewProduct->image_url }}" 
                    alt="{{ $quickViewProduct->name }}" 
                    class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
            </div>
            <div class="flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-[#414141]">{{ $quickViewProduct->name }}</h3>
                    <p class="mt-3 text-2xl font-bold text-[#9B7E5C]">IDR {{ number_format($quickViewProduct->base_price, 2, ',', '.') }}</p>
                    <div class="mt-4 prose prose-sm text-[#414141] max-h-40 overflow-y-auto custom-scrollbar">
                        {!! $quickViewProduct->description !!}
                    </div>
                </div>
                <a href="{{ route('products.detail', $quickViewProduct->slug) }}" 
                    class="mt-6 inline-block w-full text-center bg-gradient-to-r from-[#9B7E5C] to-[#B8956A] text-white py-3 px-6 rounded-lg hover:from-[#8A6D4B] hover:to-[#9B7E5C] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg font-medium">
                    See detail
                </a>
            </div>
        </div>
    </div>
    @endif

    <style>
/* Fade In Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate-fade-in {
    animation: fadeIn 0.8s ease-out forwards;
}

.animate-fade-in-delayed {
    animation: fadeIn 1s ease-out 0.3s forwards;
    opacity: 0;
}

.animate-fade-in-more-delayed {
    animation: fadeIn 0.8s ease-out 0.4s forwards;
    opacity: 0;
}

.animate-fade-in-fast {
    animation: fadeIn 0.3s ease-out forwards;
}

/* Fade In Up Animation for Products */
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

.product-card {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}

/* Slide Down Animation */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-down {
    animation: slideDown 0.5s ease-out forwards;
}

/* Scale In Animation */
@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-scale-in {
    animation: scaleIn 0.3s ease-out forwards;
}

/* Slow Pulse Animation */
@keyframes pulseSlow {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

.animate-pulse-slow {
    animation: pulseSlow 2s ease-in-out infinite;
}

/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #9B7E5C;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #8A6D4B;
}
</style>
</div>