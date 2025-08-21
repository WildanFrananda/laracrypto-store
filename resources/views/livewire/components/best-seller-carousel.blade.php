<div class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Best Seller</h2>
            <p class="mt-2 text-sm text-gray-500">Our customers' most loved products.</p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @forelse($bestSellers as $product)
                <div class="group relative">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                        <img src="https://placehold.co/400x500/f3f4f6/333333?text={{ urlencode($product->name) }}" 
                            alt="{{ $product->name }}" 
                            class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="#">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">IDR {{ number_format($product->base_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">There are no best-selling products yet.</p>
            @endforelse
        </div>
    </div>
</div>
