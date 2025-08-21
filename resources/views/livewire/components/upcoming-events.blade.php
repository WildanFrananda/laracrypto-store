<div class="bg-gray-900 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">Up coming event</h2>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @forelse($promotions as $promotion)
                <a href="{{ $promotion->link_url ?? '#' }}" class="group block">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-800">
                        <img src="{{ $promotion->image_url }}" 
                            alt="{{ $promotion->title }}" 
                            class="h-full w-full object-cover object-center transition-opacity duration-300 group-hover:opacity-80">
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-white">{{ $promotion->title }}</h3>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-400">No Upcoming Event.</p>
            @endforelse
        </div>
    </div>
</div>
