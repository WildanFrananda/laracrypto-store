{{-- resources/views/livewire/profile-page.blade.php --}}
<div>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .slide-in {
            animation: slideIn 0.4s ease-out;
        }

        .tab-content-enter {
            animation: fadeInUp 0.5s ease-out;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .status-badge-pulse {
            animation: pulse 2s ease-in-out infinite;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        }

        .input-focus-effect {
            transition: all 0.3s ease;
        }

        .input-focus-effect:focus {
            transform: scale(1.01);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .gradient-avatar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>

    <div class="py-12 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Header Profile Card --}}
            <div class="glass-effect rounded-2xl shadow-2xl p-8 mb-8 fade-in-up hover-lift">
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-full gradient-avatar flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 rounded-full border-4 border-white"></div>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <div class="mt-2 flex space-x-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                Premium Member
                            </span>
                            @if($user->hasVerifiedEmail())
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Verified
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content Card --}}
            <div class="glass-effect rounded-2xl shadow-2xl overflow-hidden slide-in">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    {{-- Tabs Navigation --}}
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button 
                                wire:click="setActiveTab('orders')" 
                                @class([
                                    'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-all duration-300 flex items-center space-x-2',
                                    'border-amber-500 text-gray-900' => $activeTab === 'orders',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'orders',
                                ])
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span>Order History</span>
                            </button>
                            
                            <button 
                                wire:click="setActiveTab('account')" 
                                @class([
                                    'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-all duration-300 flex items-center space-x-2',
                                    'border-amber-500 text-gray-900' => $activeTab === 'account',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'account',
                                ])
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Account Information</span>
                            </button>
                            
                            <button 
                                wire:click="setActiveTab('address')" 
                                @class([
                                    'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-all duration-300 flex items-center space-x-2',
                                    'border-amber-500 text-gray-900' => $activeTab === 'address',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'address',
                                ])
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Address Information</span>
                            </button>
                        </nav>
                    </div>

                    {{-- Tab Content --}}
                    <div class="mt-6">
                        @if ($activeTab === 'orders')
                            <div class="tab-content-enter">
                                @include('profile._order-history')
                            </div>
                        @elseif ($activeTab === 'account')
                            <div class="tab-content-enter">
                                @include('profile._account-information', ['user' => $user])
                            </div>
                        @elseif ($activeTab === 'address')
                            <div class="tab-content-enter">
                                <livewire:profile.address-manager />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>