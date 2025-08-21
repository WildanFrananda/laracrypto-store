<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <aside class="lg:col-span-1">
                    <h2 class="text-xl font-semibold mb-4">Filter</h2>
                    <div class="space-y-6">
                        <div>
                            <label for="sort-by" class="block text-sm font-medium text-gray-700">Sort</label>
                            <select id="sort-by" wire:model.live="sortBy" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm rounded-md">
                                <option value="latest">Newest</option>
                                <option value="price_asc">Lowest Price</option>
                                <option value="price_desc">Highest Price</option>
                            </select>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Color</h3>
                            <div class="mt-2 space-y-2">
                                @foreach($availableColors as $color)
                                    <div class="flex items-center">
                                        <input id="color-{{ $color->id }}" wire:model.live="selectedColors" value="{{ $color->id }}" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-gray-600 focus:ring-gray-500">
                                        <label for="color-{{ $color->id }}" class="ml-3 text-sm text-gray-600">{{ $color->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label for="max-price" class="block text-sm font-medium text-gray-700">Maximum Price (IDR {{ number_format($maxPrice ?? 500000, 0, ',', '.') }})</label>
                            <input id="max-price" type="range" min="50000" max="500000" step="10000" wire:model.live="maxPrice" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                        </div>
                    </div>
                </aside>
                <main class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($products as $product)
                            <div class="border rounded-lg p-4 flex flex-col group">
                                <div class="relative overflow-hidden rounded-md">
                                    <img src="https://placehold.co/600x400/e2e8f0/e2e8f0" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                </div>
                                <div class="mt-4">
                                    <h3 class="text-lg font-bold text-gray-800">
                                        <a href="{{ route('products.detail', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-2 text-md font-semibold text-gray-900">
                                        IDR {{ number_format($product->base_price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500">No products match your filters.</p>
                        @endforelse
                    </div>
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
