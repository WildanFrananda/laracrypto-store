<div x-data="{ open: true }" @click.away="open = false" class="relative">
    <input 
        type="text"
        wire:model.live.debounce.300ms="searchTerm"
        @focus="open = true"
        placeholder="Search Product..."
        class="w-full sm:w-64 px-4 py-2 border bg-[#F8F3E9] border-[#9B7E5C]-300 rounded-md focus:ring-[#9B7E5C] focus:border-[#9B7E5C]"
    >

    <div x-show="open && $wire.searchTerm.length > 2"
        x-transition
        class="absolute z-10 mt-2 w-full sm:w-96 bg-[#F8F3E9] border border-gray-200 rounded-md shadow-lg">
        @if($results->isNotEmpty())
            <ul class="divide-y divide-gray-100">
                @foreach($results as $product)
                    <li class="p-4 hover:bg-gray-50">
                        <a href="{{ route('products.detail', $product->slug) }}" class="flex items-center space-x-4">
                            <img src="https://placehold.co/80x80/f3f4f6/333333?text=Img" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-md">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                                <p class="text-sm text-gray-600">IDR {{ number_format($product->base_price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @elseif(strlen($searchTerm) > 2)
            <p class="p-4 text-sm text-[#443937]">No Result For "{{ $searchTerm }}".</p>
        @endif
    </div>
</div>
