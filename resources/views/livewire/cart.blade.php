<div class="max-w-5xl mx-auto p-4 sm:p-6">
    <h1 class="text-2xl font-bold mb-6">Вашата количка</h1>

    @if (count($cartItems) > 0)
        <div class="space-y-4">
            @foreach ($cartItems as $key => $item)
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border p-4 rounded-lg gap-4">
                    <!-- Product Image and Info -->
                    <div class="flex items-start gap-4 w-full sm:w-auto">
                        <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded overflow-hidden">
                            @if(isset($item['product']))
                                <img
                                    src="{{ $item['product']->getFirstMediaUrl('product_images') }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/100?text=Product'"
                                >
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h2 class="font-semibold">{{ $item['name'] }}</h2>
                            <p class="text-sm text-gray-600">Размер: {{ $item['size_name'] ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">Цена: ${{ number_format($item['price'], 2) }}</p>
                        </div>
                    </div>

                    <!-- Quantity Controls -->
                    <div class="flex items-center justify-between w-full sm:w-auto sm:justify-start sm:space-x-2">
                        <div class="flex items-center space-x-2">
                            <button
                                wire:click="decreaseQuantity('{{ $key }}')"
                                class="px-3 py-1 border rounded hover:bg-gray-100"
                            >
                                −
                            </button>
                            <span class="min-w-[20px] text-center">{{ $item['quantity'] }}</span>
                            <button
                                wire:click="increaseQuantity('{{ $key }}')"
                                class="px-3 py-1 border rounded hover:bg-gray-100"
                            >
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Price and Remove -->
                    <div class="flex items-center justify-between w-full sm:w-auto sm:justify-end sm:space-x-4">
                        <span class="text-lg font-semibold">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </span>
                        <button
                            wire:click="removeItem('{{ $key }}')"
                            class="text-red-500 hover:underline text-sm sm:text-base"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Checkout Section -->
        <a href="{{ route('checkout') }}" class="block mt-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 p-4 bg-gray-50 rounded-lg">
                <h2 class="text-xl font-bold">Общо: ${{ number_format($total, 2) }}</h2>
                <button class="bg-black text-white px-6 py-3 sm:py-2 rounded hover:bg-gray-800 transition w-full sm:w-auto text-center">
                Продължи към поръчката
                </button>
            </div>
        </a>
    @else
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="mt-4 text-lg text-gray-600">Количката ви е празна.</p>
            <a href="/products" class="mt-4 inline-block bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
                Продължете с пазаруването
            </a>
        </div>
    @endif
</div>