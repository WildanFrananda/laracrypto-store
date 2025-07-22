<div wire:poll.5s class="p-6 bg-gray-100 rounded-lg text-center">
    <h2 class="text-xl font-semibold">Connect to sepolia network</h2>
    @if($error)
        <p class="mt-2 text-red-500">Error: {{ $error }}</p>
    @else
        <p class="mt-2">Latest block number:</p>
        <p class="text-4xl font-bold text-blue-600">{{ $blockNumber }}</p>
    @endif
</div>