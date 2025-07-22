<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-6">Product Catalog</h2>

                @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                    <div class="border rounded-lg p-4 flex flex-col">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="rounded-md mb-4 w-full h-48 object-cover">
                        <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mt-2 flex-grow">{{ $product->description }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                @if($ethPrice)
                                <span class="text-xl font-bold text-gray-900"
                                    title="ETH Price: ${{ number_format($ethPrice, 2) }}">
                                    {{ number_format($product->price / $ethPrice, 6) }} ETH
                                </span>
                                @endif
                                <span class="block text-sm text-gray-500">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 disabled:opacity-50">
                                <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                    Add
                                </span>
                                <span wire:loading wire:target="addToCart({{ $product->id }})">
                                    ...
                                </span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>