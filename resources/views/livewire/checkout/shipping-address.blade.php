<!-- SHIPPING ADDRESS SELECTION VIEW -->
<div class="bg-gradient-to-br from-[#F8F3E9] to-[#FAF7F0] min-h-screen">
    <div class="py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Progress Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="ml-2 text-sm font-medium text-green-600">Cart</span>
                    </div>
                    <div class="w-16 h-1 bg-[#9B7E5C]"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#9B7E5C] rounded-full flex items-center justify-center text-white font-semibold">2</div>
                        <span class="ml-2 text-sm font-medium text-[#9B7E5C]">Shipping</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-semibold">3</div>
                        <span class="ml-2 text-sm font-medium text-gray-500">Payment</span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <!-- Header -->
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#9B7E5C] to-[#C4A980] rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-[#443937]">Shipping Address</h2>
                            <p class="text-[#6B5D57] mt-1">Select where you'd like your order delivered</p>
                        </div>
                    </div>

                    <!-- Address Selection -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-sm font-semibold text-[#443937] uppercase tracking-wide">Your Saved Addresses</p>
                            <span class="text-xs text-[#6B5D57] bg-[#F8F3E9] px-3 py-1 rounded-full">
                                {{ count($addresses) }} {{ count($addresses) == 1 ? 'address' : 'addresses' }}
                            </span>
                        </div>

                        @forelse($this->addresses as $address)
    <label for="address-{{ $address->id }}" 
        @class([
            'group relative flex p-6 border-2 rounded-xl cursor-pointer transition-all duration-200 hover:shadow-md',
            'bg-gradient-to-r from-amber-50 to-orange-50 border-[#9B7E5C] shadow-lg ring-4 ring-[#9B7E5C] ring-opacity-20' => $this->selectedAddressId == $address->id,
            'bg-white border-gray-200 hover:border-[#9B7E5C]' => $this->selectedAddressId != $address->id,
        ])>
                                <input type="radio" wire:model.live="selectedAddressId" value="{{ $address->id }}" id="address-{{ $address->id }}" class="sr-only">
                                
                                <!-- Radio Button Indicator -->
                                <div class="flex-shrink-0 mr-4">
                                    <div @class([
                                        'w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all',
                                        'border-[#9B7E5C] bg-[#9B7E5C]' => $selectedAddressId == $address->id,
                                        'border-gray-300 group-hover:border-[#9B7E5C]' => $selectedAddressId != $address->id,
                                    ])>
                                        @if($selectedAddressId == $address->id)
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center mb-2">
                                        <h3 class="font-bold text-lg text-[#443937]">{{ $address->label }}</h3>
                                        @if($address->is_primary)
                                        <span class="ml-3 inline-flex items-center text-xs bg-gradient-to-r from-amber-100 to-amber-200 text-amber-800 font-semibold px-3 py-1 rounded-full">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            Primary
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="space-y-2 text-sm text-[#6B5D57]">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-[#9B7E5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <span class="font-medium">{{ $address->recipient_name }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-[#9B7E5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span>{{ $address->phone_number }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <svg class="w-4 h-4 mr-2 mt-0.5 text-[#9B7E5C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span>{{ $address->full_address }}, {{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</span>
                                        </div>
                                    </div>
                                </div>

                                @if($selectedAddressId == $address->id)
                                <div class="absolute top-4 right-4">
                                    <span class="flex items-center text-xs font-semibold text-[#9B7E5C]">
                                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Selected
                                    </span>
                                </div>
                                @endif
                            </label>
                        @empty
                            <div class="text-center py-12 px-4 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50">
                                <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">No Addresses Found</h3>
                                <p class="text-sm text-gray-500 mb-4">Please add a new shipping address to continue</p>
                                <svg class="w-6 h-6 text-gray-400 mx-auto animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                </svg>
                            </div>
                        @endforelse
                    </div>

                    @error('selectedAddressId') 
                    <div class="mt-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium">{{ $message }}</span>
                        </div>
                    </div>
                    @enderror

                    <!-- Continue Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <button 
                            wire:click="proceedToPayment" 
                            wire:loading.attr="disabled"
                            class="w-full bg-gradient-to-r from-[#9B7E5C] to-[#B8936A] text-white py-4 px-6 rounded-xl font-semibold text-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center">
                            <span wire:loading.remove>
                                Continue to Payment
                                <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                            <span wire:loading class="items-center">
                                <svg class="animate-spin h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Address Manager Section -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <livewire:profile.address-manager />
                </div>
            </div>
        </div>
    </div>
    <style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-fade-in {
    animation: fade-in 0.2s ease-out;
}
</style>
</div>