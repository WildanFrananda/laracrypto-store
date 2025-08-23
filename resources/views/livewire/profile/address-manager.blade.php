<div>
    @if (session()->has('address_success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md" role="alert">
            {{ session('address_success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium text-gray-900">Saved Address</h3>
        <button wire:click="create" type="button" class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
            Add New Address
        </button>
    </div>

    <div class="space-y-4">
        @forelse($addresses as $address)
            <div class="p-4 border rounded-lg flex justify-between items-start">
                <div>
                    <p class="font-semibold">{{ $address->label }} @if($address->is_primary) <span class="text-xs bg-amber-100 text-amber-800 font-medium px-2 py-0.5 rounded-full">Primary Address</span> @endif</p>
                    <p class="text-sm text-gray-600">{{ $address->recipient_name }} ({{ $address->phone_number }})</p>
                    <p class="text-sm text-gray-600">{{ $address->full_address }}, {{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                </div>
                <div class="flex-shrink-0 flex space-x-2">
                    @unless($address->is_primary)
                        <button wire:click="setPrimary({{ $address->id }})" class="text-sm text-gray-500 hover:text-gray-900">Set as Primary</button>
                    @endunless
                    <button wire:click="edit({{ $address->id }})" class="text-sm text-gray-500 hover:text-gray-900">Edit</button>
                    <button wire:click="delete({{ $address->id }})" wire:confirm="Are you sure you want to delete this address?" class="text-sm text-red-500 hover:text-red-700">Delete</button>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">You have not added any shipping addresses.</p>
        @endforelse
    </div>

    {{-- Modal Form --}}
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg" @click.away="$wire.showModal = false">
            <h3 class="text-lg font-medium mb-4">{{ $editingAddress->exists ? 'Edit Address' : 'Add New Address' }}</h3>
            <form wire:submit.prevent="save">
                <div class="space-y-4">
                    <input wire:model="label" type="text" placeholder="Label (e.g., Home, Office)" class="w-full border-gray-300 rounded-md">
                    @error('label') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    <input wire:model="recipient_name" type="text" placeholder="Recipient Name" class="w-full border-gray-300 rounded-md">
                    @error('recipient_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    <input wire:model="phone_number" type="text" placeholder="Phone Number" class="w-full border-gray-300 rounded-md">
                    @error('phone_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    <textarea wire:model="full_address" placeholder="Full Address" class="w-full border-gray-300 rounded-md"></textarea>
                    @error('full_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <input wire:model="city" type="text" placeholder="City" class="w-full border-gray-300 rounded-md">
                        <input wire:model="province" type="text" placeholder="Province" class="w-full border-gray-300 rounded-md">
                        <input wire:model="postal_code" type="text" placeholder="Postal Code" class="w-full border-gray-300 rounded-md">
                    </div>
                    @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    @error('province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    @error('postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" @click="$wire.showModal = false" class="px-4 py-2 bg-gray-200 rounded-md">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
