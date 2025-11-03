<div class="bg-gradient-to-br from-[#F8F3E9] via-[#FCF8F0] to-[#F8F3E9] min-h-screen">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-2xl transition-all duration-300 hover:shadow-2xl">
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                        <!-- Image Section -->
                        <div class="animate-[fadeInLeft_0.6s_ease-out]">
                            <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl mb-4 overflow-hidden shadow-lg group">
                                <img src="{{ $mainImageUrl ?? 'https://placehold.co/600x600/e2e8f0/e2e8f0' }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover rounded-2xl transition-transform duration-500 group-hover:scale-110">
                            </div>
                        </div>

                        <!-- Product Info Section -->
                        <div class="animate-[fadeInRight_0.6s_ease-out]">
                            @if (session()->has('message'))
                                <div class="mb-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-md animate-[slideInDown_0.5s_ease-out]" role="alert">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ session('message') }}
                                    </div>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="mb-4 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg shadow-md animate-[slideInDown_0.5s_ease-out]" role="alert">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                            
                            <h1 class="text-4xl font-bold text-[#443937] mb-2 transition-all duration-300 hover:text-[#CEA87C]">
                                {{ $product->name }}
                            </h1>
                            
                            <div class="flex items-baseline mt-4 mb-8">
                                <p class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C]">
                                    @if($this->selectedVariant)
                                        IDR {{ number_format($this->selectedVariant->price, 2, ',', '.') }}
                                    @else
                                        IDR {{ number_format($product->base_price, 2, ',', '.') }}
                                    @endif
                                </p>
                            </div>
                            
                            <!-- Color Selection -->
                            <div class="mt-8 p-6 bg-gradient-to-br from-gray-50 to-white rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center mb-4">
                                    <svg class="w-5 h-5 text-[#CEA87C] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"/>
                                    </svg>
                                    <h3 class="text-base font-semibold text-[#443937]">Pilih Warna</h3>
                                </div>
                                <fieldset class="mt-2">
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($product->colors as $color)
                                            <label class="relative group cursor-pointer">
                                                <input type="radio" wire:model.live="selectedColorId" value="{{ $color->id }}" class="sr-only" />
                                                <span style="background-color: {{ $color->hex_code }}" 
                                                      class="h-10 w-10 rounded-full border-2 border-gray-200 block transition-all duration-300 
                                                             {{ $selectedColorId == $color->id ? 'ring-4 ring-offset-2 ring-[#CEA87C] scale-110 shadow-lg' : 'hover:scale-110 hover:shadow-md' }}">
                                                </span>
                                                @if($selectedColorId == $color->id)
                                                    <svg class="absolute -top-1 -right-1 w-5 h-5 text-[#CEA87C] bg-white rounded-full animate-[scaleIn_0.3s_ease-out]" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                @endif
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Material Selection -->
                            <div class="mt-6 p-6 bg-gradient-to-br from-gray-50 to-white rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center mb-4">
                                    <svg class="w-5 h-5 text-[#CEA87C] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/>
                                        <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/>
                                        <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/>
                                    </svg>
                                    <h3 class="text-base font-semibold text-[#443937]">Pilih Bahan</h3>
                                </div>
                                <fieldset class="mt-2">
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($product->variants as $variant)
                                            <label class="relative group cursor-pointer">
                                                <input type="radio" wire:model.live="selectedMaterialId" value="{{ $variant->material_id }}" class="sr-only" />
                                                <span class="inline-block px-5 py-3 border-2 rounded-lg text-sm font-medium transition-all duration-300 
                                                             {{ $selectedMaterialId == $variant->material_id 
                                                                ? 'bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white border-[#CEA87C] shadow-lg scale-105' 
                                                                : 'bg-white text-[#443937] border-gray-200 hover:border-[#CEA87C] hover:shadow-md hover:scale-105' }}">
                                                    {{ $variant->material->name }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Quantity and Actions -->
                            <div class="mt-8 p-6 bg-gradient-to-br from-gray-50 to-white rounded-xl shadow-sm border border-gray-100">
                                <div class="flex items-center justify-between mb-6">
                                    <label for="quantity" class="text-base font-semibold text-[#443937]">Kuantitas</label>
                                    <div class="flex items-center border-2 border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                        <button wire:click="decrementQuantity" 
                                                class="px-5 py-3 text-[#443937] hover:bg-[#CEA87C] hover:text-white transition-all duration-300 font-bold text-xl">
                                            −
                                        </button>
                                        <span class="w-16 text-center font-semibold text-lg text-[#443937] bg-white">{{ $quantity }}</span>
                                        <button wire:click="incrementQuantity" 
                                                class="px-5 py-3 text-[#443937] hover:bg-[#CEA87C] hover:text-white transition-all duration-300 font-bold text-xl">
                                            +
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <button wire:click="addToCart" 
                                            class="group w-full bg-gradient-to-r from-[#242621] to-[#443937] text-white py-4 rounded-xl font-semibold 
                                                   hover:from-[#443937] hover:to-[#242621] transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl
                                                   flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span>Add to Cart</span>
                                    </button>
                                    <button wire:click="buyNow" 
                                            class="group w-full bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white py-4 rounded-xl font-semibold 
                                                   hover:from-[#9B7E5C] hover:to-[#7A6349] transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl
                                                   flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        <span>Buy Now</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div x-data="{ activeTab: 'description' }" class="mt-12 border-t-2 border-gray-200 pt-8">
                        <div class="bg-white rounded-xl shadow-sm p-2 inline-flex space-x-2">
                            <button @click="activeTab = 'description'" 
                                    :class="{ 
                                        'bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white shadow-md': activeTab === 'description', 
                                        'text-[#443937] hover:bg-gray-100': activeTab !== 'description' 
                                    }" 
                                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span>Deskripsi</span>
                                </div>
                            </button>
                            <button @click="activeTab = 'reviews'" 
                                    :class="{ 
                                        'bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] text-white shadow-md': activeTab === 'reviews', 
                                        'text-[#443937] hover:bg-gray-100': activeTab !== 'reviews' 
                                    }" 
                                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span>Ulasan</span>
                                </div>
                            </button>
                        </div>

                        <div class="mt-8">
                            <div x-show="activeTab === 'description'" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 class="prose max-w-none text-[#443937] bg-white p-8 rounded-xl shadow-sm">
                                {!! $product->description !!}
                            </div>
                            <div x-show="activeTab === 'reviews'"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                <livewire:product-reviews :product="$product" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    @keyframes scaleIn {
        from {
            transform: scale(0);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>
</div>
