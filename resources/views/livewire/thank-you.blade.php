<div class="max-w-3xl mx-auto p-6 text-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-green-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>

    <h1 class="text-2xl font-bold mb-4">Благодарим ви за поръчката, {{ $order->customer_name }}!</h1>
    <p class="mb-2">Вашата поръчка #{{ $order->id }} е получена успешно.</p>
    <p class="mb-6">Ще ви се обадим на посочения телефонен номер за потвърждение.</p>

    <div class="bg-white p-6 rounded-lg shadow-sm text-left max-w-md mx-auto mb-8">
        <h2 class="font-semibold text-lg mb-4 border-b pb-2">Детайли на поръчката:</h2>
        <p class="mb-2"><strong>Име:</strong> {{ $order->customer_name }}</p>
        <p class="mb-2"><strong>Номер на поръчка:</strong> #{{ $order->id }}</p>
        <p class="mb-2"><strong>Адрес:</strong> {{ $order->shipping_address }}</p>
        <p class="mb-2"><strong>Телефон:</strong> {{ $order->phone_number }}</p>
        <p class="mb-2"><strong>Доставка:</strong> {{ $order->delivery_option === 'econt' ? 'Еконт' : 'Спиди' }}</p>
        <p class="mb-4"><strong>Общо:</strong> ${{ number_format($order->total_price, 2) }}</p>

        <h3 class="font-semibold mt-4 mb-2 border-t pt-3">Продукти:</h3>
        <ul class="divide-y">
            @foreach($order->items as $item)
                <li class="py-2 flex justify-between">
                    <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                    <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <a href="/" class="inline-block mt-6 bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
        Обратно към началната страница
    </a>
</div>