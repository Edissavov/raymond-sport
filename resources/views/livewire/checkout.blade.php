<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    @if (session()->has('error'))
        <div class="text-red-500 mb-4">{{ session('error') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="text-green-500 mb-4">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
    <label for="shipping" class="block font-medium">Shipping Address</label>
    <input type="text" id="shipping" wire:model="shippingAddress"
           class="w-full border rounded px-3 py-2 mt-1" required>
</div>

    <ul class="divide-y mb-6">
        @foreach ($cart as $item)
            <li class="py-4 flex justify-between">
                <div>
                    <strong>{{ $item['name'] }}</strong> ({{ $item['size_name'] }})<br>
                    Qty: {{ $item['quantity'] }}
                </div>
                <div>${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
            </li>
        @endforeach
    </ul>

    <div class="text-right">
        <p class="text-xl font-semibold mb-3">Total: ${{ number_format($total, 2) }}</p>
        <button wire:click="placeOrder"
                class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
            Place Order
        </button>
    </div>
</div>
