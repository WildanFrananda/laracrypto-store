<div class="bg-gradient-to-br from-[#F8F3E9] to-[#FAF7F0] min-h-screen">
    <div class="py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-[#443937] mb-2">Shopping Cart</h1>
                <p class="text-[#6B5D57]">Review your items before checkout</p>
            </div>

            @if (session()->has('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-r-lg shadow-sm"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif

            @if ($cartItems->isNotEmpty())
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items Section -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $variantId => $item)
                    <div wire:key="{{ $variantId }}"
                        class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center gap-6">
                                <!-- Product Image Placeholder -->
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-[#9B7E5C] to-[#C4A980] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-[#443937] mb-1 truncate">{{
                                        $item['product_name'] }}</h3>
                                    <p class="text-sm text-[#6B5D57] mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        {{ $item['material'] }}
                                    </p>

                                    <div class="flex items-center gap-4 flex-wrap">
                                        <!-- Price -->
                                        <div class="text-[#9B7E5C] font-bold text-lg">
                                            IDR {{ number_format((float)$item['price'], 0, ',', '.') }}
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div
                                            class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                            <button
                                                wire:click="updateQuantity({{ $variantId }}, {{ max(1, (int)$item['quantity'] - 1) }})"
                                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-[#443937] transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            <input type="number" min="1"
                                                wire:model.live.debounce.300ms="cartItems.{{ $variantId }}.quantity"
                                                wire:change="updateQuantity({{ $variantId }}, $event.target.value)"
                                                class="w-16 text-center border-0 focus:ring-0 py-2 text-[#443937] font-medium">
                                            <button
                                                wire:click="updateQuantity({{ $variantId }}, {{ (int)$item['quantity'] + 1 }})"
                                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-[#443937] transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="ml-auto">
                                            <div class="text-sm text-[#6B5D57] mb-1">Subtotal</div>
                                            <div class="text-lg font-bold text-[#443937]">
                                                IDR {{ number_format((float)$item['price'] * (int)$item['quantity'], 0,
                                                ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <button wire:click="removeItem({{ $variantId }})"
                                    class="text-gray-400 hover:text-red-600 transition-colors p-2 hover:bg-red-50 rounded-lg"
                                    title="Remove item">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary Section -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md sticky top-8">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-[#443937] mb-6">Order Summary</h2>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-[#6B5D57]">
                                    <span>Items ({{ count($cartItems) }})</span>
                                    <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-[#6B5D57]">
                                    <span>Shipping</span>
                                    <span class="text-green-600 font-medium">Calculated at checkout</span>
                                </div>

                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between items-baseline">
                                        <span class="text-xl font-semibold text-[#443937]">Total</span>
                                        <span class="text-2xl font-bold text-[#9B7E5C]">
                                            IDR {{ number_format($total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}"
                                class="block w-full bg-gradient-to-r from-[#9B7E5C] to-[#B8936A] text-white text-center py-4 px-6 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                Continue to Payment
                                <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>

                            <a href="{{ route('products.catalog') }}">
                                <button
                                    class="mt-3 w-full text-[#9B7E5C] text-center py-3 px-6 rounded-lg font-medium hover:bg-[#F8F3E9] transition-colors">
                                    Continue Shopping
                                </button>
                            </a>

                            <!-- Trust Badges -->
                            <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                                <div class="flex items-center text-sm text-[#6B5D57]">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Secure checkout
                                </div>
                                <div class="flex items-center text-sm text-[#6B5D57]">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Free returns within 30 days
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Empty Cart State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-32 h-32 bg-[#F8F3E9] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-16 h-16 text-[#9B7E5C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#443937] mb-3">Your cart is empty</h3>
                    <p class="text-[#6B5D57] mb-8">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('products.catalog') }}"
                        class="inline-block bg-gradient-to-r from-[#9B7E5C] to-[#B8936A] text-white py-3 px-8 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        Start Shopping
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>