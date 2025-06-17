<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Your Cart</h1>

    @if (count($cartItems) > 0)
        <div class="space-y-4">
            @foreach ($cartItems as $key => $item)
                <div class="flex justify-between items-center border p-4 rounded-lg">
                    <div>
                        <h2 class="font-semibold">{{ $item['name'] }}</h2>
                        <p class="text-sm text-gray-600">Size: {{ $item['size_name'] }}</p>
                        <p class="text-sm text-gray-600">Price: ${{ number_format($item['price'], 2) }}</p>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button wire:click="decreaseQuantity('{{ $key }}')" class="px-2 py-1 border rounded">−</button>
                        <span>{{ $item['quantity'] }}</span>
                        <button wire:click="increaseQuantity('{{ $key }}')" class="px-2 py-1 border rounded">+</button>
                    </div>

                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-semibold">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </span>
                        <button wire:click="removeItem('{{ $key }}')" class="text-red-500 hover:underline">Remove</button>
                    </div>
                </div>
            @endforeach
        </div>
 <a href="{{ route('checkout') }}">
        <div class="mt-6 flex justify-between items-center">
     
   
     <h2 class="text-xl font-bold">Total: ${{ number_format($total, 2) }}</h2>
            <button class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
                Proceed to Checkout
            </button>
        </div>
        </a> 
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
