<div>
    {{-- Sisipkan script Midtrans Snap JS --}}
    @push('scripts')
    <script type="text/javascript"
        src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out forwards;
        }

        .animate-checkmark {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: checkmark 0.6s ease-out forwards;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .payment-button {
            position: relative;
            overflow: hidden;
        }

        .payment-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .payment-button:hover::before {
            width: 300px;
            height: 300px;
        }
    </style>
    @endpush

    <div x-data @initiate-payment.window="
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
        ">
        <div class="py-12 bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- Tampilan Saat Pemrosesan atau Selesai --}}
                @if($isProcessing)
                <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl animate-fade-in-up">
                    <div class="p-8 text-gray-900 text-center" wire:poll.3s="checkOrderStatus">
                        @if($order->status->value === 'awaiting_confirmation')
                        <div class="max-w-md mx-auto">
                            <div class="mb-6 relative">
                                <div
                                    class="w-24 h-24 mx-auto bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-12 h-12 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                                <div
                                    class="absolute inset-0 w-24 h-24 mx-auto bg-amber-400 rounded-full opacity-20 animate-ping">
                                </div>
                            </div>

                            <h2
                                class="text-3xl font-bold mb-3 bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                Menunggu Konfirmasi
                            </h2>
                            <p class="text-gray-600 mb-8 text-lg">
                                Pembayaran Anda sedang diproses. Mohon jangan tutup halaman ini.
                            </p>

                            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-6 mb-6">
                                <div class="flex items-center justify-center space-x-3 mb-4">
                                    <div class="w-3 h-3 rounded-full bg-amber-500 animate-pulse"
                                        style="animation-delay: -0.3s"></div>
                                    <div class="w-3 h-3 rounded-full bg-amber-500 animate-pulse"
                                        style="animation-delay: -0.15s"></div>
                                    <div class="w-3 h-3 rounded-full bg-amber-500 animate-pulse"></div>
                                </div>
                                <p class="text-sm text-gray-600">
                                    Status: <span class="font-semibold text-amber-700">{{ $order->status->name }}</span>
                                </p>
                            </div>

                            <div class="space-y-3 mb-6">
                                <a href="{{ route('profile.show') }}"
                                    class="block w-full bg-gradient-to-r from-amber-600 to-orange-600 text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300 text-center">
                                    Lihat Pesanan Saya
                                </a>
                                <p class="text-xs text-center text-gray-500">
                                    Anda dapat meninggalkan halaman ini. Kami akan memberitahu Anda melalui email.
                                </p>
                            </div>

                            <div class="text-xs text-gray-400 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Transaksi Anda aman dan terenkripsi
                            </div>
                        </div>

                        @elseif($order->status->value === 'completed')
                        <div x-data x-init="
                                    setTimeout(() => {
                                        window.location.href = '{{ route('profile.show') }}';
                                    }, 7000);
                                " class="max-w-md mx-auto">
                            <div class="mb-6 relative">
                                <div
                                    class="w-24 h-24 mx-auto bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path class="animate-checkmark" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="absolute inset-0 w-24 h-24 mx-auto">
                                    <div class="w-full h-full bg-green-400 rounded-full opacity-20 animate-ping"></div>
                                </div>
                            </div>

                            <h3
                                class="text-3xl font-bold mb-3 bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                Pembayaran Berhasil! 🎉
                            </h3>
                            <p class="text-gray-600 mb-6 text-lg">
                                Pesanan Anda sedang diproses. Terima kasih telah berbelanja.
                            </p>

                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 mb-6">
                                <div class="flex items-center justify-center gap-2 text-green-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-semibold">Transaksi Dikonfirmasi</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-center gap-2 text-sm text-gray-500">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span>Mengarahkan dalam 7 detik...</span>
                            </div>
                        </div>

                        @elseif($order->status->value === 'failed')
                        <div class="max-w-md mx-auto">
                            <div
                                class="w-24 h-24 mx-auto bg-gradient-to-br from-red-400 to-rose-500 rounded-full flex items-center justify-center shadow-lg mb-6">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>

                            <h2 class="text-3xl font-bold mb-3 text-red-600">Pembayaran Gagal</h2>
                            <p class="text-gray-600 mb-6 text-lg">
                                Terjadi masalah saat memverifikasi pembayaran Anda. Silakan hubungi dukungan pelanggan.
                            </p>

                            <button
                                class="bg-gradient-to-r from-red-500 to-rose-500 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                                Hubungi Support
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @else
                {{-- Tampilan Awal Sebelum Pembayaran --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Kolom Kiri: Detail Pesanan --}}
                    <div class="lg:col-span-2 space-y-6">
                        {{-- Alamat Pengiriman --}}
                        <div class="bg-white p-8 shadow-xl rounded-2xl hover-lift animate-fade-in-up"
                            style="animation-delay: 0.1s">
                            <div class="flex items-center gap-3 border-b pb-4 mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Alamat Pengiriman</h3>
                            </div>
                            <div class="space-y-2 text-gray-700">
                                <p class="font-bold text-lg text-gray-900">{{ $order->shipping_recipient_name }}</p>
                                <p class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    {{ $order->shipping_phone_number }}
                                </p>
                                <p class="text-gray-600 leading-relaxed">{{ $order->shipping_full_address }}</p>
                                <p class="text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{
                                    $order->shipping_postal_code }}</p>
                            </div>
                        </div>

                        {{-- Ringkasan Item --}}
                        <div class="bg-white p-8 shadow-xl rounded-2xl hover-lift animate-fade-in-up"
                            style="animation-delay: 0.2s">
                            <div class="flex items-center gap-3 border-b pb-4 mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Ringkasan Item</h3>
                            </div>
                            <div class="space-y-4">
                                @foreach($order->items as $index => $item)
                                <div class="flex justify-between items-start p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-md transition-all duration-300"
                                    style="animation: fadeInUp 0.6s ease-out {{ ($index + 1) * 0.1 }}s forwards; opacity: 0;">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 mb-1">{{ $item->variant->product->name }}
                                        </p>
                                        <p class="text-sm text-gray-600">{{ $item->variant->material->name }}</p>
                                        <p class="text-sm text-amber-600 font-medium mt-1">
                                            {{ $item->quantity }} × IDR {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-lg text-gray-900">IDR {{ number_format($item->price *
                                            $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Opsi Pembayaran --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white p-8 shadow-xl rounded-2xl sticky top-8 animate-slide-in-right">
                            <div class="flex items-center gap-3 border-b pb-4 mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Pembayaran</h3>
                            </div>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-700">
                                    <span>Subtotal</span>
                                    <span class="font-semibold">IDR {{ number_format($order->total_amount, 0, ',', '.')
                                        }}</span>
                                </div>
                                <div class="flex justify-between text-gray-700">
                                    <span>Pengiriman</span>
                                    <span class="font-semibold text-green-600">Gratis</span>
                                </div>
                                <div class="h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                                <div class="flex justify-between items-center pt-2">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span
                                        class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                        IDR {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                @if($midtransSnapToken)
                                <button x-on:click="window.snap.pay('{{ $midtransSnapToken }}', { 
                                            onSuccess: function(result){ 
                                                $wire.call('handleMidtransSuccess', result);
                                            },
                                            onPending: function(result){
                                                $wire.call('handleMidtransPending', result);
                                            },
                                            onError: function(result){
                                                alert('Pembayaran gagal. Silakan coba lagi.');
                                            },
                                            onClose: function(){
                                                console.log('Popup ditutup');
                                            }
                                        })"
                                    class="payment-button w-full flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 px-6 rounded-xl font-semibold hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 10a2 2 0 00-2 2v.5a.5.5 0 00.5.5h15a.5.5 0 00.5-.5V16a2 2 0 00-2-2H4z" />
                                    </svg>
                                    <span>Bayar dengan Midtrans</span>
                                </button>
                                @endif

                                {{-- @if($cryptoAmount)
                                <button
                                    x-on:click="$dispatch('initiate-payment', [{ amount: {{ $cryptoAmount }}, toAddress: '{{ $recipientAddress }}' }])"
                                    class="payment-button w-full flex items-center justify-center gap-3 bg-gradient-to-r from-gray-900 to-gray-800 text-white py-4 px-6 rounded-xl font-semibold hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M8.433 7.418c.158-.103.346-.196.567-.267v1.698a2.5 2.5 0 00-.567-.267C8.07 8.488 8 8.731 8 9c0 .269.07.512.433.582.158.103.346.196.567-.267v1.698a2.5 2.5 0 00.567-.267c.363-.236.433-.479.433-.582 0-.269-.07-.512-.433-.582zM10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.5 4.5 0 00-1.831.976A4.5 4.5 0 006.092 9H5a1 1 0 100 2h1.092a4.5 4.5 0 001.031 2.932A4.5 4.5 0 009 14.908V15a1 1 0 102 0v-.092a4.5 4.5 0 001.831-.976A4.5 4.5 0 0013.908 11H15a1 1 0 100-2h-1.092a4.5 4.5 0 00-1.031-2.932A4.5 4.5 0 0011 6.092V6z" />
                                    </svg>
                                    <span>Bayar dengan Crypto</span>
                                </button>
                                @endif --}}
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex items-start gap-3 text-xs text-gray-500">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="leading-relaxed">Transaksi Anda dilindungi dengan enkripsi SSL 256-bit
                                        dan sistem keamanan terkini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>