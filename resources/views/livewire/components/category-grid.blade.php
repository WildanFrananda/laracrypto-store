<div class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Categories</h2>
            <p class="mt-2 text-sm text-gray-500">Find products based on your favorite categories.</p>
        </div>

        <div class="mt-10 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 md:grid-cols-4 lg:gap-x-8">
            @foreach($categories as $category)
                <a href="#" class="group block">
                    <div class="relative overflow-hidden rounded-lg aspect-w-1 aspect-h-1">
                        <img src="https://placehold.co/400x400/f3f4f6/333333?text={{ urlencode($category->name) }}"
                            alt="{{ $category->name }}"
                            class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-gray-900">{{ $category->name }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</div>