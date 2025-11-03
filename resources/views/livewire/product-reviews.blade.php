<div class="bg-gradient-to-br from-[#F8F3E9] to-[#FCF8F0] py-8 px-4 rounded-2xl">
    <div class="flex items-center mb-6">
        <svg class="w-7 h-7 text-[#CEA87C] mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
        <h3 class="text-2xl font-bold text-[#443937]">Customer Reviews</h3>
    </div>

    {{-- Formulir Ulasan Baru --}}
    @auth
        <div class="mb-8 bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
            @if (session()->has('review_success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 animate-[slideIn_0.5s_ease-out]" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-green-700 font-medium">{{ session('review_success') }}</span>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="submitReview" class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <h4 class="ml-4 text-lg font-semibold text-[#443937]">Share Your Experience</h4>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-[#443937] mb-3">Rate this product</label>
                        <div class="flex items-center space-x-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" wire:click="$set('rating', {{ $i }})" class="group transition-transform duration-200 hover:scale-125">
                                    <svg @class([
                                        'w-8 h-8 transition-all duration-300',
                                        'text-amber-400 drop-shadow-md' => $i <= $rating,
                                        'text-gray-300 group-hover:text-amber-200' => $i > $rating
                                    ]) fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </button>
                            @endfor
                            @if($rating > 0)
                                <span class="ml-3 text-sm font-medium text-[#443937] animate-[fadeIn_0.3s_ease-in]">({{ $rating }}/5)</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-[#443937] mb-2">Your review</label>
                        <textarea 
                            wire:model="comment" 
                            placeholder="Tell us what you think about this product..." 
                            rows="4"
                            class="w-full border-2 border-gray-200 rounded-lg shadow-sm focus:border-[#CEA87C] focus:ring-2 focus:ring-[#CEA87C] focus:ring-opacity-50 transition-all duration-300 p-4 text-[#443937]"
                        ></textarea>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#CEA87C] to-[#9B7E5C] border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-[#9B7E5C] hover:to-[#7A6349] transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-xl"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Submit Review
                    </button>
                </form>
            @endif
        </div>
    @else
        <div class="mb-8 p-6 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl border-2 border-dashed border-[#CEA87C] text-center">
            <svg class="w-12 h-12 text-[#CEA87C] mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <p class="text-[#443937] mb-2">Want to share your thoughts?</p>
            <a href="{{ route('login') }}" class="inline-flex items-center text-[#CEA87C] font-semibold hover:text-[#9B7E5C] transition-colors duration-300">
                Login to write a review
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    @endauth

    {{-- Daftar Ulasan --}}
    <div class="space-y-4">
        @forelse ($reviews as $review)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 animate-[fadeInUp_0.5s_ease-out]">
                <div class="flex space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-[#CEA87C] to-[#9B7E5C] flex items-center justify-center font-bold text-white text-lg shadow-md">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-base font-bold text-[#443937]">{{ $review->user->name }}</h4>
                            <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg @class([
                                    'w-5 h-5',
                                    'text-amber-400' => $i <= $review->rating,
                                    'text-gray-300' => $i > $review->rating
                                ]) fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm font-semibold text-[#443937]">{{ $review->rating }}.0</span>
                        </div>
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-xl border-2 border-dashed border-gray-200">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                <p class="text-gray-500 font-medium">No reviews yet for this product</p>
                <p class="text-sm text-gray-400 mt-1">Be the first to share your experience!</p>
            </div>
        @endforelse
    </div>

    @if($reviews->hasPages())
        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    @endif

    <style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
</div>
