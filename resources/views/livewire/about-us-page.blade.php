<div>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <div class="text-sm mb-8">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-gray-700">About Us</span>
            </div>

            {{-- We Are Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">We Are</h2>
                    <div class="mt-4 prose lg:prose-lg text-gray-600">
                        {!! $settings->narrative !!}
                    </div>
                </div>
                <div>
                    {{-- Placeholder for image collage --}}
                    <div class="aspect-w-4 aspect-h-3 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Image Collage</span>
                    </div>
                </div>
            </div>

            {{-- Statistics Section --}}
            <div class="mt-16 bg-gray-50 rounded-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div>
                        <p class="text-4xl font-bold text-amber-600">{{ $settings->total_orders }}+</p>
                        <p class="mt-2 text-base font-medium text-gray-600">Total Orders</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-amber-600">{{ $settings->active_customers }}+</p>
                        <p class="mt-2 text-base font-medium text-gray-600">Active Customers</p>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-amber-600">{{ $settings->store_branches }}+</p>
                        <p class="mt-2 text-base font-medium text-gray-600">Store Branch</p>
                    </div>
                </div>
            </div>

            {{-- Gallery Section --}}
            <div class="mt-16">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Gallery</h2>
                </div>
                <div class="mt-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($settings->gallery_images as $image)
                        <div class="aspect-w-1 aspect-h-1">
                            <img class="w-full h-full object-cover rounded-lg" src="{{ $image['url'] }}" alt="Gallery Image">
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
