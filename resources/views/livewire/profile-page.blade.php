<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">My Profile</h2>

                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button wire:click="setActiveTab('orders')" @class([
                                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm',
                                'border-amber-500 text-gray-900' => $activeTab === 'orders',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'orders',
                            ])>
                                Order History
                            </button>
                            <button wire:click="setActiveTab('account')" @class([
                                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm',
                                'border-amber-500 text-gray-900' => $activeTab === 'account',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'account',
                            ])>
                                Account Information
                            </button>
                            <button wire:click="setActiveTab('address')" @class([
                                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm',
                                'border-amber-500 text-gray-900' => $activeTab === 'address',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'address',
                            ])>
                                Address Information
                            </button>
                        </nav>
                    </div>

                    <div class="mt-6">
                        @if ($activeTab === 'orders')
                            @include('profile._order-history')
                        @elseif ($activeTab === 'account')
                            @include('profile._account-information', ['user' => $user])
                        @elseif ($activeTab === 'address')
                            <livewire:profile.address-manager />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
