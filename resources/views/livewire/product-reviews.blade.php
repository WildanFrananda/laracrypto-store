<div class="py-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Review</h3>

    {{-- Formulir Ulasan Baru --}}
    @auth
        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
            @if (session()->has('review_success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md" role="alert">
                    {{ session('review_success') }}
                </div>
            @else
                <form wire:submit.prevent="submitReview">
                    <h4 class="font-semibold mb-2">Write Your Review</h4>

                    <div class="flex items-center space-x-1 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('rating', {{ $i }})">
                                <svg @class(['w-6 h-6', 'text-amber-400' => $i <= $rating, 'text-gray-300' => $i > $rating]) fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>
                        @endfor
                    </div>
                    
                    <textarea wire:model="comment" placeholder="Share your experience for this product..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
                    
                    <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                        Submit Review
                    </button>
                </form>
            @endif
        </div>
    @else
        <p class="text-sm text-gray-600 mb-6">Please <a href="{{ route('login') }}" class="text-amber-600 underline">login</a> For writing the review.</p>
    @endauth

    <div class="space-y-6">
        @forelse ($reviews as $review)
            <div class="flex space-x-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600">
                        {{ substr($review->user->name, 0, 1) }}
                    </div>
                </div>
                <div>
                    <div class="flex items-center">
                        <h4 class="text-sm font-bold text-gray-900">{{ $review->user->name }}</h4>
                        <div class="ml-4 flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg @class(['w-4 h-4', 'text-amber-400' => $i <= $review->rating, 'text-gray-300' => $i > $review->rating]) fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-600">{{ $review->comment }}</p>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">No review yet for this product.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $reviews->links() }}
    </div>
</div>
