<div class="relative bg-[#202020] py-12 sm:py-16 overflow-hidden" id="events">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 bg-center bg-repeat opacity-5" style="background-image: url('{{ asset('images/upcomingbg.webp') }}');"></div>
    
    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#443937]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#443937]/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center animate-fade-in">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl mb-2">
                Upcoming Events
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-[#F8F3E9] to-transparent mx-auto mb-4"></div>
            <p class="max-w-2xl mx-auto text-md text-gray-400">
                Discover exciting events and experiences coming your way
            </p>
        </div>

        {{-- Events Grid --}}
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($promotions as $promotion)
                <div class="group relative transform transition-all duration-500 hover:scale-105">
                    {{-- Card --}}
                    <div class="relative w-full h-96 rounded-2xl overflow-hidden bg-gradient-to-br from-white to-gray-100 shadow-xl hover:shadow-2xl transition-shadow duration-500">
                        {{-- Image --}}
                        <div class="absolute inset-0">
                            <img src="{{ $promotion->image_url }}" 
                                 alt="{{ $promotion->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        </div>
                        
                        {{-- Overlay Blur Effect --}}
                        <div class="absolute inset-0 bg-white/20 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        {{-- Content --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-end p-6 text-center">
                            {{-- Icon --}}
                            <div class="mb-4 h-12 w-12 bg-[#F8F3E9]/90 backdrop-blur-sm rounded-full flex items-center justify-center transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-12 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#443937]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            
                            {{-- Title --}}
                            <h3 class="text-xl font-bold text-white mb-2 transform transition-all duration-500 group-hover:translate-y-[-4px]">
                                {{ $promotion->title }}
                            </h3>
                            
                            {{-- Date --}}
                            @if($promotion->event_date)
                                <p class="text-sm text-white/90 mb-4 font-medium">
                                    {{ $promotion->event_date->format('l, d F Y') }}
                                </p>
                            @endif
                            
                            {{-- Button --}}
                            <button 
                                wire:click="showDetails({{ $promotion->id }})" 
                                class="relative px-6 py-2 bg-[#F8F3E9] text-[#443937] rounded-full font-medium shadow-lg hover:bg-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl group/btn overflow-hidden"
                            >
                                <span class="relative z-10 flex items-center gap-2">
                                    See Details
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-[#443937]/0 via-[#443937]/10 to-[#443937]/0 transform translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-700"></div>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="inline-block p-8 bg-white/5 rounded-2xl backdrop-blur-sm">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-400 text-lg">No upcoming events at this time.</p>
                        <p class="text-gray-500 text-sm mt-2">Check back soon for exciting updates!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Enhanced Modal --}}
    @if($showModal && $selectedPromotion)
    <div class="fixed inset-0 z-50 flex items-center justify-center px-4 animate-modal-fade-in" wire:click="closeModal">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>
        
        {{-- Modal Content --}}
        <div class="relative bg-gradient-to-br from-[#F8F3E9] to-[#EDE4D3] rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden transform transition-all duration-500 animate-modal-scale-in" 
             wire:click.stop
             @click.away="$wire.closeModal()">
            
            {{-- Close Button --}}
            <button 
                wire:click="closeModal" 
                class="absolute top-4 right-4 z-10 p-2 bg-white/90 hover:bg-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 hover:rotate-90 group"
            >
                <svg class="w-6 h-6 text-[#443937]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Image Header --}}
            @if($selectedPromotion->image_url)
            <div class="relative h-64 overflow-hidden">
                <img src="{{ $selectedPromotion->image_url }}" 
                     alt="{{ $selectedPromotion->title }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#F8F3E9] to-transparent"></div>
            </div>
            @endif

            {{-- Content --}}
            <div class="p-8 overflow-y-auto max-h-[calc(90vh-16rem)]">
                {{-- Icon & Title --}}
                <div class="flex items-start gap-4 mb-6">
                    <div class="flex-shrink-0 h-14 w-14 bg-[#443937] rounded-2xl flex items-center justify-center shadow-lg transform hover:rotate-12 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-[#443937] mb-2">
                            {{ $selectedPromotion->title }}
                        </h3>
                        @if($selectedPromotion->subtitle)
                        <p class="text-lg text-[#443937]/70 font-medium">
                            {{ $selectedPromotion->subtitle }}
                        </p>
                        @endif
                    </div>
                </div>

                {{-- Date Badge --}}
                @if($selectedPromotion->event_date)
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#443937] text-white rounded-full text-sm font-medium mb-6 shadow-lg">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $selectedPromotion->event_date->format('l, d F Y') }}
                </div>
                @endif

                {{-- Divider --}}
                <div class="w-full h-px bg-gradient-to-r from-transparent via-[#443937]/20 to-transparent mb-6"></div>

                {{-- Details --}}
                <div class="prose prose-lg max-w-none text-[#443937] prose-headings:text-[#443937] prose-a:text-[#443937] prose-strong:text-[#443937]">
                    {!! $selectedPromotion->details !!}
                </div>

                {{-- Action Button --}}
                <div class="mt-8 flex gap-4">
                    <button 
                        wire:click="closeModal" 
                        type="button" 
                        class="flex-1 px-6 py-3 bg-[#443937] text-white hover:bg-[#332B29] rounded-xl font-medium shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Custom Animations --}}
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes modal-fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes modal-scale-in {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-modal-fade-in {
            animation: modal-fade-in 0.3s ease-out;
        }

        .animate-modal-scale-in {
            animation: modal-scale-in 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Custom scrollbar for modal */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: rgba(68, 57, 55, 0.1);
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: rgba(68, 57, 55, 0.3);
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(68, 57, 55, 0.5);
        }
    </style>
</div>