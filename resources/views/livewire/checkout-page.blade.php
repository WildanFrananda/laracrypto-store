<div>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Order Summary</h2>

                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <div class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="font-medium">{{ $item['product_name'] }} ({{ $item['material'] }})</p>
                                    <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                </div>
                                <p class="text-lg font-semibold">
                                    IDR {{ number_format((float)$item['price'] * (int)$item['quantity'], 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200 text-right">
                        <p class="text-2xl font-bold">Total: IDR {{ number_format($total, 0, ',', '.') }}</p>
                        <button 
                            wire:click="placeOrder"
                            wire:loading.attr="disabled"
                            class="mt-4 inline-block bg-gray-900 text-white py-3 px-6 rounded-md hover:bg-gray-800 disabled:opacity-50">
                            Place Order & Continue to Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
