<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Navigation - Left Column -->
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Account Settings</h2>
                </div>
                <nav class="space-y-1 p-4">
                    <a
                        href="{{ route('profile.info') }}"
                        @class([
                            'block w-full text-left px-4 py-2 text-sm font-medium rounded-md transition',
                            'bg-blue-50 text-blue-700' => request()->routeIs('profile.info'),
                            'text-gray-600 hover:text-gray-900 hover:bg-gray-50' => !request()->routeIs('profile.info')
                        ])
                        wire:navigate
                    >
                        Profile Information
                    </a>
                    <a
                        href="{{ route('profile.orders') }}"
                        @class([
                            'block w-full text-left px-4 py-2 text-sm font-medium rounded-md transition',
                            'bg-blue-50 text-blue-700' => request()->routeIs('profile.orders'),
                            'text-gray-600 hover:text-gray-900 hover:bg-gray-50' => !request()->routeIs('profile.orders')
                        ])
                        wire:navigate
                    >
                        Order History
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content - Right Column -->
        <div class="md:w-3/4">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>
                            <p class="text-gray-600 mt-1">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $order->status_name }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h2 class="text-lg font-medium mb-2">Customer Information</h2>
                            <div class="space-y-1">
                                <p><span class="font-medium">Name:</span> {{ $order->customer_name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $order->phone_number }}</p>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-lg font-medium mb-2">Shipping Information</h2>
                            <div class="space-y-1">
                                <p><span class="font-medium">Address:</span> {{ $order->shipping_address }}</p>
                                <p><span class="font-medium">Delivery:</span> {{ $order->delivery_option_name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-lg font-medium mb-4">Order Items</h2>
                        <div class="border-t border-gray-200">
                            @foreach($order->items as $item)
                            <div class="py-4 flex items-center border-b border-gray-200">
                                <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden">
                                    <img
                                        src="{{ $item->product->getFirstMediaUrl('product_images') }}"
                                        alt="{{ $item->product->name }}"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="text-sm font-medium">{{ $item->product->name }}</h3>
                                            <p class="text-sm text-gray-500 mt-1">Size: {{ $item->size->name }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium">${{ number_format($item->price, 2) }}</p>
                                            <p class="text-sm text-gray-500 mt-1">Qty: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <div class="w-full md:w-1/3">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium">Subtotal</span>
                                    <span>${{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Shipping</span>
                                    <span>$0.00</span>
                                </div>
                                <div class="flex justify-between border-t border-gray-200 pt-2">
                                    <span class="font-medium">Total</span>
                                    <span class="font-bold">${{ number_format($order->total_price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a
                    href="{{ route('profile.orders') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    wire:navigate
                >
                    &larr; Back to Orders
                </a>
            </div>
        </div>
    </div>
</div>