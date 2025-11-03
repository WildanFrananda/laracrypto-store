<div class="bg-[#F8F3E9]">
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-[#443937]">
                    <h2 class="text-2xl font-semibold mb-6">Shipping address</h2>

                    <div class="space-y-4">
                        <p class="text-sm font-medium text-[#443937]">Choose your shipping address:</p>
                        @forelse($addresses as $address)
                            <label for="address-{{ $address->id }}" 
                                @class([
                                    'flex p-4 border rounded-lg cursor-pointer',
                                    'bg-amber-50 border-amber-500 ring-2 ring-amber-500' => $selectedAddressId == $address->id,
                                    'bg-white border-gray-200' => $selectedAddressId != $address->id,
                                ])>
                                <input type="radio" wire:model.live="selectedAddressId" value="{{ $address->id }}" id="address-{{ $address->id }}" class="sr-only">
                                <div class="w-full">
                                    <p class="font-semibold">{{ $address->label }} @if($address->is_primary) <span class="text-xs bg-amber-100 text-amber-800 font-medium px-2 py-0.5 rounded-full">Primary</span> @endif</p>
                                    <p class="text-sm text-[#443937]">{{ $address->recipient_name }} ({{ $address->phone_number }})</p>
                                    <p class="text-sm text-[#443937]">{{ $address->full_address }}, {{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                                </div>
                            </label>
                        @empty
                            <p class="text-sm text-[#443937] p-4 border rounded-lg">No addresses found, please add new address below.</p>
                        @endforelse
                    </div>
                    @error('selectedAddressId') <span class="text-red-500 text-sm mt-2">{{ $message }}</span> @enderror

                    <div class="mt-6 border-t pt-6">
                        <button 
                            wire:click="proceedToPayment" 
                            wire:loading.attr="disabled"
                            class="w-full bg-[#9B7E5C] text-white py-3 px-6 rounded-md hover:bg-gray-800 disabled:opacity-50">
                            Continue to Payment
                        </button>
                    </div>

                </div>
            </div>

            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-[#443937]">
                    <livewire:profile.address-manager />
                </div>
            </div>

        </div>
    </div>
</div>
