<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <div class="aspect-square bg-gray-200 rounded-lg">
                            <img src="https://placehold.co/600x600/e2e8f0/e2e8f0" alt="{{ $product->name }}"
                                class="w-full h-full object-cover rounded-lg">
                        </div>
                    </div>

                    <div>
                        @if (session()->has('message'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('message') }}</span>
                        </div>
                        @endif
                        @if (session()->has('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                        @endif

                        <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                        <p class="mt-4 text-3xl text-gray-700">
                            @if($this->selectedVariant)
                                IDR {{ number_format($this->selectedVariant->price, 0, ',', '.') }}
                            @else
                                IDR {{ number_format($product->base_price, 0, ',', '.') }}
                            @endif
                        </p>

                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-900">Description</h3>
                            <div class="mt-2 text-base text-gray-600">
                                {!! $product->description !!}
                            </div>
                        </div>

                        <div class="mt-8">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Material</h3>
                                <fieldset class="mt-2">
                                    <legend class="sr-only">Choose Material</legend>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($product->variants as $variant)
                                        <label class="relative">
                                            <input type="radio" wire:model.live="selectedMaterialId"
                                                value="{{ $variant->material_id }}" class="sr-only" />
                                            <span
                                                class="cursor-pointer px-4 py-2 border rounded-md text-sm {{ $selectedMaterialId == $variant->material_id ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-900 border-gray-200' }}">
                                                {{ $variant->material->name }}
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-sm font-medium text-gray-900">Color</h3>
                                <fieldset class="mt-2">
                                    <legend class="sr-only">Choose Color</legend>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($product->colors as $color)
                                        <label class="relative">
                                            <input type="radio" wire:model.live="selectedColorId"
                                                value="{{ $color->id }}" class="sr-only" />
                                            <span style="background-color: {{ $color->hex_code }}"
                                                class="h-8 w-8 rounded-full border border-black border-opacity-10 block cursor-pointer {{ $selectedColorId == $color->id ? 'ring-2 ring-offset-1 ring-gray-900' : '' }}"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="mt-6">
                            @if($this->selectedVariant)
                                @if($this->selectedVariant->stock > 0)
                                    <p class="text-sm text-green-600">Ready Stock</p>
                                @else
                                    <p class="text-sm text-red-600">Out of Stock</p>
                                @endif
                            @endif
                        </div>
                        <div class="mt-8 flex gap-4">
                            <button 
                                type="button" 
                                wire:click="addToCart" 
                                wire:loading.attr="disabled"
                                @if(!$this->selectedVariant || $this->selectedVariant->stock <= 0) disabled @endif
                                class="flex-1 bg-gray-900 text-white py-3 px-6 rounded-md hover:bg-gray-800 disabled:opacity-50 disabled:cursor-not-allowed">
                                Add to Cart
                            </button>
                            <livewire:components.wishlist-button :product="$product" :key="$product->id" />
                        </div>
                    </div>
                </div>
            </div>
            <div x-data="{ activeTab: 'description' }" class="mt-12">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button @click="activeTab = 'description'" :class="{ 'border-amber-500 text-gray-900': activeTab === 'description', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'description' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Description
                        </button>
                        <button @click="activeTab = 'reviews'" :class="{ 'border-amber-500 text-gray-900': activeTab === 'reviews', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'reviews' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Reviews
                        </button>
                    </nav>
                </div>

                <div class="mt-6">
                    <div x-show="activeTab === 'description'" class="prose max-w-none text-gray-600">
                        {!! $product->description !!}
                    </div>
                    <div x-show="activeTab === 'reviews'">
                        <livewire:product-reviews :product="$product" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>