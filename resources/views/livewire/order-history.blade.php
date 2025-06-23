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
            <h1 class="text-3xl font-bold mb-8">Your Order History</h1>

            @if($orders->isEmpty())
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <p class="text-gray-600">You haven't placed any orders yet.</p>
                    <a href="{{ route('shop') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Start Shopping
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                                    <div class="mb-4 md:mb-0">
                                        <h2 class="text-lg font-semibold">Order #{{ $order->id }}</h2>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6">
                                        <div>
                                            <span class="text-sm font-medium text-gray-500">Total</span>
                                            <p class="font-semibold">${{ number_format($order->total_price, 2) }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500">Status</span>
                                            <p class="font-semibold">{{ $order->status_name }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-500">Delivery</span>
                                            <p class="font-semibold">{{ $order->delivery_option_name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="font-medium mb-4">Items</h3>
                                <div class="space-y-4">
                                    @foreach($order->items as $item)
                                        <div class="flex items-center">
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
                                                        <h4 class="text-sm font-medium">{{ $item->product->name }}</h4>
                                                        <p class="text-sm text-gray-500">Size: {{ $item->size->name }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm font-medium">${{ number_format($item->price, 2) }}</p>
                                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm text-gray-500">Shipped to</p>
                                        <p class="font-medium">{{ $order->shipping_address }}</p>
                                    </div>
                                    <a
                                        href="{{ route('orders.show', $order->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                                        wire:navigate
                                    >
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($orders->hasMorePages())
                    <div class="mt-8 text-center">
                        <button
                            wire:click="loadMore"
                            wire:loading.attr="disabled"
                            class="bg-white border border-gray-300 rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                        >
                            <span wire:loading.remove>Load More Orders</span>
                            <span wire:loading>Loading...</span>
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
