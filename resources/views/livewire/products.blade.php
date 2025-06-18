<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8" x-data="{ mobileFiltersOpen: false }">
    <!-- Header and Mobile Filter Toggle -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Нашите продукти</h2>
        <button @click="mobileFiltersOpen = true" class="md:hidden flex items-center space-x-2 text-gray-700 border border-gray-300 px-4 py-2 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
            <span>Filters</span>
        </button>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Desktop Filters (Left Sidebar) -->
        <div class="hidden md:block w-64 flex-shrink-0">
            <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-bold text-lg mb-4 pb-2 border-b border-gray-200">Филтри</h3>

                <!-- Categories Filter -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-900 mb-3">Категории</h4>
                    <div class="space-y-2">
                        <a
                            href="{{ route('products') }}"
                            wire:navigate
                            class="block w-full text-left px-3 py-2 text-sm rounded transition-colors
                                {{ request()->routeIs('products') ? 'bg-blue-50 text-blue-700 font-medium' : 'hover:bg-gray-50' }}"
                        >
                            Всички категории
                        </a>

                        @foreach ($categories as $cat)
                            <a
                                href="{{ route('products.category', $cat->slug) }}"
                                wire:navigate
                                class="block w-full text-left px-3 py-2 text-sm rounded transition-colors
                                    {{ request()->is('products/category/'.$cat->slug) ? 'bg-blue-50 text-blue-700 font-medium' : 'hover:bg-gray-50' }}"
                            >
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Filters (Slide-out Panel) -->
        <div x-show="mobileFiltersOpen" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="fixed inset-0 z-50 bg-white p-6 overflow-y-auto md:hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Filters</h3>
                <button @click="mobileFiltersOpen = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Categories Filter -->
            <div class="mb-8">
                <h4 class="font-medium text-gray-900 mb-3">Categories</h4>
                <div class="space-y-2">
                    <a
                        href="{{ route('products') }}"
                        wire:navigate
                        @click="mobileFiltersOpen = false"
                        class="block w-full text-left px-3 py-2 text-sm rounded transition-colors
                            {{ request()->routeIs('products') ? 'bg-blue-50 text-blue-700 font-medium' : 'hover:bg-gray-50' }}"
                    >
                        All Categories
                    </a>

                    @foreach ($categories as $cat)
                        <a
                            href="{{ route('products.category', $cat->slug) }}"
                            wire:navigate
                            @click="mobileFiltersOpen = false"
                            class="block w-full text-left px-3 py-2 text-sm rounded transition-colors
                                {{ request()->is('products/category/'.$cat->slug) ? 'bg-blue-50 text-blue-700 font-medium' : 'hover:bg-gray-50' }}"
                        >
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <button
                @click="mobileFiltersOpen = false"
                class="w-full mt-6 py-3 bg-black text-white rounded-lg font-medium"
            >
                Show Results
            </button>
        </div>

        <!-- Product Grid -->
        <div class="flex-1">
            <!-- Active Filters (for desktop) -->
            <div class="hidden md:flex items-center gap-2 mb-6">
                @if(request()->routeIs('products.category'))
                    <span class="inline-flex items-center bg-gray-100 px-3 py-1 rounded-full text-sm">
                        {{ $categories->firstWhere('slug', request()->category)?->name }}
                        <a href="{{ route('products') }}" wire:navigate class="ml-2 text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @forelse ($products as $product)
                    <a href="{{ route('product-show', $product->slug) }}" wire:navigate class="group">
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow h-full flex flex-col border border-gray-100">
                            <div class="aspect-square overflow-hidden">
                                <img
                                    src="{{ $product->getFirstMediaUrl('product_images') }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    loading="lazy"
                                >
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="mt-auto text-lg font-bold text-gray-900">
                                    ${{ number_format($product->price, 2) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Продуктът не е наличен</h3>
                        <a
                            href="{{ route('products') }}"
                            wire:navigate
                            class="mt-4 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors text-sm"
                        >
                            Изчисти Филтрите
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>