<div
    x-data
    @initiate-payment.window="
        async (event) => {
            const { amount, toAddress } = event.detail[0];

            if (typeof window.ethereum === 'undefined') {
                return alert('Please install MetaMask!');
            }

            try {
                const provider = new ethers.BrowserProvider(window.ethereum);
                const signer = await provider.getSigner();

                const tx = await signer.sendTransaction({
                    to: toAddress,
                    value: ethers.parseEther(amount)
                });

                $wire.dispatch('payment-sent', { txHash: tx.hash });

            } catch (error) {
                console.error('Payment failed or was canceled:', error);
                alert('Transaction was canceled or failed.');
            }
        }
    "
>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Shopping Cart</h2>

                    @if (empty($cart))
                        <p>Your shopping cart is empty.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($cart as $id => $details)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $details['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $details['quantity'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button wire:click="removeItem({{ $id }})" class="text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6 text-right">
                            <p class="text-lg">Total: <span class="font-bold">${{ number_format($totalUSD, 2) }}</span></p>
                            <p class="text-md text-gray-600">Estimated Total: <span class="font-bold">{{ number_format($totalETH, 6) }} ETH</span></p>
                            <button
                                wire:click="placeOrder"
                                wire:loading.attr="disabled"
                                class="mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 disabled:opacity-50">
                                Pay with Crypto
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
