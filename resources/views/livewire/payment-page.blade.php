<div>
    {{-- Sisipkan script Midtrans Snap JS --}}
    @push('scripts')
        <script type="text/javascript"
          src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
          data-client-key="{{ config('services.midtrans.client_key') }}"></script> 
    @endpush

    <div
        x-data
        @initiate-payment.window="
            async (event) => {
                const { amount, toAddress } = event.detail[0];
                if (typeof window.ethereum === 'undefined') { return alert('Tolong install MetaMask!'); }
                try {
                    const provider = new ethers.BrowserProvider(window.ethereum);
                    const signer = await provider.getSigner();
                    const tx = await signer.sendTransaction({ to: toAddress, value: ethers.parseEther(amount.toString()) });
                    $wire.dispatch('payment-sent', { txHash: tx.hash });
                } catch (error) {
                    console.error('Pembayaran gagal:', error);
                    alert('Transaksi dibatalkan atau gagal.');
                }
            }
        "
    >
        <div class="py-12 bg-[#F8F3E9]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                {{-- Tampilan Saat Pemrosesan atau Selesai --}}
                @if($isProcessing)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-8 text-gray-900 text-center" wire:poll.3s="checkOrderStatus">
                            @if($order->status->value === 'awaiting_confirmation')
                                <h2 class="text-2xl font-semibold mb-2">Menunggu Konfirmasi...</h2>
                                <p class="text-gray-600 mb-6">Pembayaran Anda sedang diproses. Mohon jangan tutup halaman ini.</p>
                                <div class="flex justify-center items-center my-8">
                                    <div class="flex items-center justify-center space-x-2">
                                        <div class="w-4 h-4 rounded-full bg-amber-500 animate-pulse [animation-delay:-0.3s]"></div>
                                        <div class="w-4 h-4 rounded-full bg-amber-500 animate-pulse [animation-delay:-0.15s]"></div>
                                        <div class="w-4 h-4 rounded-full bg-amber-500 animate-pulse"></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500">Status saat ini: <span class="font-semibold">{{ $order->status->name }}</span></p>
                            @elseif($order->status->value === 'completed')
                                {{-- Tampilan Popup Sukses --}}
                                <div x-data x-init="
                                    setTimeout(() => {
                                        window.location.href = '{{ route('profile.show') }}';
                                    }, 7000);
                                ">
                                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                        <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900">Pembayaran Berhasil!</h3>
                                    <p class="mt-2 text-sm text-gray-600">Pesanan Anda sedang diproses. Terima kasih telah berbelanja.</p>
                                    <p class="mt-4 text-xs text-gray-400">Anda akan diarahkan dalam 7 detik...</p>
                                </div>
                            @elseif($order->status->value === 'failed')
                                <h2 class="text-2xl font-semibold mb-2 text-red-600">Pembayaran Gagal</h2>
                                <p class="text-gray-600 mb-6">Terjadi masalah saat memverifikasi pembayaran Anda. Silakan hubungi dukungan pelanggan.</p>
                            @endif
                        </div>
                    </div>
                @else
                    {{-- Tampilan Awal Sebelum Pembayaran --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Kolom Kiri: Detail Pesanan --}}
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white p-6 shadow-sm rounded-lg">
                                <h3 class="text-lg font-semibold border-b pb-4">Alamat Pengiriman</h3>
                                <div class="mt-4 text-sm text-gray-600">
                                    <p class="font-bold">{{ $order->shipping_recipient_name }}</p>
                                    <p>{{ $order->shipping_phone_number }}</p>
                                    <p>{{ $order->shipping_full_address }}</p>
                                    <p>{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>
                                </div>
                            </div>
                            <div class="bg-white p-6 shadow-sm rounded-lg">
                                <h3 class="text-lg font-semibold border-b pb-4">Ringkasan Item</h3>
                                <div class="mt-4 space-y-4">
                                    @foreach($order->items as $item)
                                        <div class="flex justify-between items-center text-sm">
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $item->variant->product->name }} ({{ $item->variant->material->name }})</p>
                                                <p class="text-gray-500">{{ $item->quantity }} x IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                                            </div>
                                            <p class="font-semibold">IDR {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Opsi Pembayaran --}}
                        <div class="lg:col-span-1">
                            <div class="bg-white p-6 shadow-sm rounded-lg sticky top-8">
                                <h3 class="text-lg font-semibold border-b pb-4">Pilih Pembayaran</h3>
                                <div class="mt-4 border-b pb-4">
                                    <div class="flex justify-between text-sm">
                                        <span>Subtotal</span>
                                        <span>IDR {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm mt-2">
                                        <span>Pengiriman</span>
                                        <span>Gratis</span>
                                    </div>
                                </div>
                                <div class="flex justify-between font-bold text-lg mt-4">
                                    <span>Total</span>
                                    <span>IDR {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </div>

                                <div class="mt-6 space-y-4">
                                    @if($midtransSnapToken)
                                        <button x-on:click="window.snap.pay('{{ $midtransSnapToken }}', { onSuccess: function(result){ $wire.set('isProcessing', true) } })" class="w-full flex items-center justify-center gap-3 bg-blue-600 text-white py-3 px-6 rounded-md hover:bg-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 10a2 2 0 00-2 2v.5a.5.5 0 00.5.5h15a.5.5 0 00.5-.5V16a2 2 0 00-2-2H4z" /></svg>
                                            <span>Midtrans</span>
                                        </button>
                                    @endif
                                    {{-- @if($cryptoAmount)
                                        <button x-on:click="$dispatch('initiate-payment', [{ amount: {{ $cryptoAmount }}, toAddress: '{{ $recipientAddress }}' }])" class="w-full flex items-center justify-center gap-3 bg-gray-900 text-white py-3 px-6 rounded-md hover:bg-gray-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M8.433 7.418c.158-.103.346-.196.567-.267v1.698a2.5 2.5 0 00-.567-.267C8.07 8.488 8 8.731 8 9c0 .269.07.512.433.582.158.103.346.196.567-.267v1.698a2.5 2.5 0 00.567-.267c.363-.236.433-.479.433-.582 0-.269-.07-.512-.433-.582zM10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.5 4.5 0 00-1.831.976A4.5 4.5 0 006.092 9H5a1 1 0 100 2h1.092a4.5 4.5 0 001.031 2.932A4.5 4.5 0 009 14.908V15a1 1 0 102 0v-.092a4.5 4.5 0 001.831-.976A4.5 4.5 0 0013.908 11H15a1 1 0 100-2h-1.092a4.5 4.5 0 00-1.031-2.932A4.5 4.5 0 0011 6.092V6z" /></svg>
                                            <span>Crypto</span>
                                        </button>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
