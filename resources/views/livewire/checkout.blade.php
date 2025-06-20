<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif


    <div class="space-y-4">
        <div>
            <label for="name" class="block font-medium mb-1">Име и фамилия*</label>
            <input type="text" id="name" wire:model="customerName"
                   class="w-full border rounded px-3 py-2">
            @error('customerName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <!-- Shipping Address -->
        <div>
            <label for="shipping" class="block font-medium mb-1">Адрес за доставка*</label>
            <input type="text" id="shipping" wire:model="shippingAddress"
                   class="w-full border rounded px-3 py-2">
            @error('shippingAddress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone" class="block font-medium mb-1">Телефонен номер*</label>
            <input type="tel" id="phone" wire:model="phoneNumber"
                   class="w-full border rounded px-3 py-2">
            @error('phoneNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Delivery Option -->
        <div>
            <label class="block font-medium mb-1">Начин на доставка*</label>
            <div class="flex space-x-4">
                <label class="flex items-center">
                    <input type="radio" wire:model="deliveryOption" value="econt" class="mr-2">
                    <span>Еконт</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" wire:model="deliveryOption" value="speedy" class="mr-2">
                    <span>Спиди</span>
                </label>
            </div>
            @error('deliveryOption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Order Summary -->
    <div class="mt-8 border-t pt-4">
        <h2 class="text-lg font-semibold mb-4">Обобщение на поръчката</h2>
        <ul class="divide-y">
            @foreach ($cart as $item)
                <li class="py-3 flex justify-between border-black border-t-2 border-b-2">
                    <div class="">
                        <strong>{{ $item['name'] }}</strong> ({{ $item['size_name'] }})
                        <span class="block text-sm">Количество: {{ $item['quantity'] }}</span>
                    </div>
                    <div>${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                </li>
            @endforeach
        </ul>

        <div x-data="{ loading: false }" class="mt-4 text-right">
            <p class="text-xl font-semibold">Общо: ${{ number_format($total, 2) }}</p>
            <button
            wire:click="placeOrder"
            class="mt-4 bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
            Поръчай
        </button>
        </div>
    </div>
</div>