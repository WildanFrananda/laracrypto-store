{{-- resources/views/profile/_order-history.blade.php --}}
@php
    use App\Enums\OrderStatus;
@endphp

<div>
    <h3 class="text-xl font-semibold mb-6 text-gray-800">Recent Orders</h3>
    
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Order Number
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            {{ $order->order_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            IDR {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span @class([
                                'px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200',
                                'bg-yellow-100 text-yellow-800 status-badge-pulse' => in_array($order->status, [OrderStatus::PENDING, OrderStatus::AWAITING_CONFIRMATION]),
                                'bg-green-100 text-green-800' => $order->status === OrderStatus::COMPLETED,
                                'bg-red-100 text-red-800' => $order->status === OrderStatus::FAILED,
                                'bg-blue-100 text-blue-800' => $order->status === OrderStatus::SHIPPED,
                            ])>
                                {{ ucfirst(str_replace('_', ' ', $order->status->value)) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <p class="text-gray-500 font-medium">You don't have any orders yet.</p>
                                <p class="text-gray-400 text-sm mt-1">Start shopping to see your order history here.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>