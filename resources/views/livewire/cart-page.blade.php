<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Shopping Cart</h2>

                    @if (session()->has('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($cartItems->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($cartItems as $variantId => $item)
                                    <tr wire:key="{{ $variantId }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item['product_name'] }}</div>
                                            <div class="text-sm text-gray-500">{{ $item['material'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">IDR {{ number_format((float)$item['price'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input 
                                                type="number" 
                                                min="1"
                                                wire:model.live.debounce.300ms="cartItems.{{ $variantId }}.quantity"
                                                wire:change="updateQuantity({{ $variantId }}, $event.target.value)"
                                                class="w-20 border-gray-300 rounded-md shadow-sm">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">IDR {{ number_format((float)$item['price'] * (int)$item['quantity'], 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button wire:click="removeItem({{ $variantId }})" class="text-red-600 hover:text-red-900">&times;</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 text-right">
                            <p class="text-xl">Total: <span class="font-bold">IDR {{ number_format($total, 0, ',', '.') }}</span></p>
                            <a href="{{ route('checkout.index') }}" class="mt-4 inline-block bg-gray-900 text-white py-3 px-6 rounded-md hover:bg-gray-800">
                                Continue To Payment
                            </a>
                        </div>
                    @else
                        <p class="text-center text-gray-500">Your shopping cart is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
