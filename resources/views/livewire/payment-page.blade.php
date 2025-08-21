<div>
    @push('scripts')
        <script type="text/javascript"
            src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    @endpush
    <div x-data @initiate-payment.window="
        async (event) => {
            const { amount, toAddress } = event.detail[0];
            if (typeof window.ethereum === 'undefined') { return alert('Please install MetaMask!'); }
            try {
                const provider = new ethers.BrowserProvider(window.ethereum);
                const signer = await provider.getSigner();
                const tx = await signer.sendTransaction({
                    to: toAddress,
                    value: ethers.parseEther(amount.toString())
                });
                $wire.dispatch('payment-sent', { txHash: tx.hash });
            } catch (error) {
                console.error('Payment failed:', error);
                alert('Transaction was canceled or failed.');
            }
        }
    ">
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900 text-center">
                        @if($isProcessing)
                            <div wire:poll.3s="checkOrderStatus">
                                @if($order->status === 'awaiting_confirmation')
                                    <h2 class="text-2xl font-semibold mb-2">Waiting for Confirmation...</h2>
                                    <p class="text-gray-600 mb-6">Your payment is being processed on the blockchain. Please do
                                        not close this page.</p>
                                    <div class="flex justify-center items-center my-8">
                                        <svg class="animate-spin h-10 w-10 text-gray-900" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500">Current Status: <span class="font-semibold">{{
                                            ucfirst(str_replace('_', ' ', $order->status)) }}</span></p>
                                @elseif($order->status === 'completed')
                                    <h2 class="text-2xl font-semibold mb-2 text-green-600">Payment Confirmed!</h2>
                                    <p class="text-gray-600 mb-6">Your order has been confirmed. Thank you for shopping.</p>
                                    <a href="#"
                                        class="mt-4 inline-block bg-gray-900 text-white py-3 px-6 rounded-md hover:bg-gray-800">
                                        View Order History
                                    </a>
                                @elseif($order->status === 'failed')
                                    <h2 class="text-2xl font-semibold mb-2 text-red-600">Payment Failed</h2>
                                    <p class="text-gray-600 mb-6">There was a problem verifying your payment. Please contact
                                        customer support.</p>
                                @endif
                            </div>
                        @else
                            <h2 class="text-2xl font-semibold mb-2">Complete Your Payment</h2>
                            <p class="text-gray-600 mb-6">Order #{{ $order->order_number }}</p>
                            <div class="border-t border-b py-6 my-6">
                                <p class="text-lg">Total Amount</p>
                                <p class="text-4xl font-bold">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                            <div class="space-y-4">
                                @if($midtransSnapToken)
                                <div class="p-4 bg-blue-50 rounded-lg">
                                    <p class="text-sm text-gray-600">Credit Card, Virtual Account, E-Wallet</p>
                                    <button x-on:click="window.snap.pay('{{ $midtransSnapToken }}')"
                                        class="mt-2 w-full bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700">
                                        Pay with Transfer
                                    </button>
                                </div>
                                @endif
                                @if($cryptoAmount)
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <p class="text-sm text-gray-600">Pay with Crypto (ETH)</p>
                                        <p class="text-xl font-mono my-2">{{ number_format($cryptoAmount, 8) }} ETH</p>
                                        <button
                                            x-on:click="$dispatch('initiate-payment', [{ amount: {{ $cryptoAmount }}, toAddress: '{{ $recipientAddress }}' }])"
                                            class="w-full bg-gray-900 text-white py-3 px-6 rounded-md hover:bg-gray-800">
                                            Pay with MetaMask
                                        </button>
                                    </div>
                                @else
                                    <div class="p-4 bg-red-50 text-red-700 rounded-lg">
                                        Unable to load crypto prices at this time. Please try again later.
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>