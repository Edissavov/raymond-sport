<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-8" x-data="{
    selectedSizeId: @entangle('selectedSizeId'),
    showNotification: false,
    animateButton: false,
    zoom: false,
    mouseX: 50,
    mouseY: 50,
    touchZoom: false,
    touchX: 50,
    touchY: 50,
    addToCart() {
        if (!this.selectedSizeId) {
            return;
        }

        this.animateButton = true;
        setTimeout(() => this.animateButton = false, 300);

        @this.addToCart().then(() => {
            this.showNotification = true;
            setTimeout(() => this.showNotification = false, 3000);
        });
    },
    handleTouch(e) {
        if (!this.touchZoom) return;
        const rect = e.currentTarget.getBoundingClientRect();
        this.touchX = ((e.touches[0].clientX - rect.left) / rect.width) * 100;
        this.touchY = ((e.touches[0].clientY - rect.top) / rect.height) * 100;
    }
}">

    <!-- [Keep your existing notification code exactly the same] -->
    <div x-show="showNotification" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full"
    class="fixed top-4 right-4 z-[9999] w-full max-w-xs">
    <div class="p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg shadow-lg flex items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 text-green-600" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
        </svg>

        <div>
            <p class="font-medium">Добавено в количката!</p>
            <p class="text-sm">Успешно добавихте <span class="font-bold">{{$product->name}}</span> в количката.</p>
        </div>
        <button @click="showNotification = false" class="ml-auto text-green-500 hover:text-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
    <!-- Product Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 lg:gap-12">
        <!-- Enhanced Product Image with Desktop + Mobile Zoom -->
        <div class="relative">
            <div class="group rounded-lg md:rounded-xl overflow-hidden shadow-md md:shadow-lg bg-gray-50 relative cursor-zoom-in"
                @mouseenter="zoom = true"
                @mousemove="mouseX = ($event.offsetX / $event.target.offsetWidth) * 100;
                            mouseY = ($event.offsetY / $event.target.offsetHeight) * 100"
                @mouseleave="zoom = false"
                @touchstart.prevent="touchZoom = true; zoom = true; handleTouch($event)"
                @touchmove.prevent="handleTouch($event)"
                @touchend="touchZoom = false; zoom = false">

                <div class="overflow-hidden aspect-square">
                    <img
                        src="{{ $product->getFirstMediaUrl('product_images') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-contain transition-transform duration-300 ease-in-out select-none"
                        :class="{ 'scale-150': zoom }"
                        :style="`transform-origin: ${touchZoom ? touchX : mouseX}% ${touchZoom ? touchY : mouseY}%`"
                        loading="lazy"
                    >
                    <div class="absolute inset-0 bg-transparent transition-all duration-300 pointer-events-none"
                        :class="{ 'bg-black/10': zoom }"></div>
                </div>

                @if ($product->productSizes->sum('stock') === 0)
                    <div class="absolute top-2 md:top-4 right-2 md:right-4 bg-red-600 text-white px-2 py-0.5 md:px-3 md:py-1 rounded-full text-xs font-semibold shadow-sm md:shadow-md">
                        Няма в наличност
                    </div>
                @endif

                <!-- Mobile Zoom Instructions -->
                <div x-show="!zoom" class="md:hidden absolute bottom-2 left-0 right-0 text-center">
                    <div class="inline-block bg-black/70 text-white text-xs px-2 py-1 rounded">
                        Докоснете и задръжте, за да увеличите
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details -->
        <div class="flex flex-col mt-4 md:mt-0">
            <div class="flex-1">
                <div class="mb-2 md:mb-4">
                    @if ($product->category)
                        <a href="{{ route('products.category', $product->category->slug) }}"
                           wire:navigate
                           wire:loading.class="opacity-75"
                           wire:loading.attr="disabled"
                           class="inline-block border-2 px-2 py-0.5 md:px-3 md:py-1 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full text-xs font-medium transition-colors duration-200 cursor-pointer">
                            {{ $product->category->name }}
                            <span wire:loading wire:target="navigate">
                                <svg class="animate-spin ml-1 h-3 w-3 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </a>
                    @else
                        <span
                            class="inline-block px-2 py-0.5 md:px-3 md:py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">
                        </span>
                    @endif
                </div>

                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-2 md:mb-3">{{ $product->name }}</h1>

                <p class="text-xl md:text-2xl font-semibold text-gray-900 mb-4 md:mb-6">
                    ${{ number_format($product->price, 2) }}
                </p>

                <div class="prose max-w-none text-gray-700 mb-4 md:mb-8">
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Size Selection -->
                <div class="mb-4 md:mb-8">
                    <h3 class="text-sm font-medium text-gray-900 mb-2 md:mb-3">Размери:</h3>
                    <ul class="grid grid-cols-3 gap-2 md:gap-3">
                        @foreach ($product->productSizes as $ps)
                            <li>
                                <input type="radio" id="size-{{ $ps->size_id }}" name="size" class="peer hidden"
                                    value="{{ $ps->size_id }}" x-model="selectedSizeId"
                                    @if ($ps->stock <= 0) disabled @endif />
                                <label for="size-{{ $ps->size_id }}"
                                    class="flex flex-col items-center justify-center h-full p-2 md:p-3 border-2 rounded-md md:rounded-lg cursor-pointer transition-colors text-sm md:text-base
                                    peer-checked:border-black peer-checked:bg-black peer-checked:text-white
                                    {{ $ps->stock > 0
                                        ? 'border-gray-200 hover:border-gray-300 bg-white text-gray-900'
                                        : 'border-gray-100 bg-gray-50 text-gray-400 cursor-not-allowed' }}">
                                    <span class="font-medium">{{ $ps->size->name }}</span>
                                    <span
                                        class="text-xs mt-0.5 md:mt-1 {{ $ps->stock > 0 ? 'text-gray-500' : 'text-gray-400' }}">
                                        {{ $ps->stock > 0 ? 'В наличност' : 'Няма в наличност' }}
                                    </span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Add to Cart Section -->
            <div class="border-t border-gray-200 pt-4 md:pt-6">
                <button @click="addToCart" :disabled="!selectedSizeId"
                    class="w-full bg-black text-white px-4 py-3 md:px-6 md:py-4 rounded-lg hover:bg-gray-800 transition-all duration-300
                           disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center
                           relative overflow-hidden text-sm md:text-base"
                    :class="{ 'scale-[0.98]': animateButton }">
                    <span class="relative z-10 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-1 md:mr-2"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Купи
                    </span>

                    <span class="absolute inset-0 bg-green-600 opacity-0 transition-opacity duration-300"
                        :class="{ 'opacity-10': animateButton }"></span>

                    <template x-if="animateButton">
                        <span class="absolute inset-0 flex items-center justify-center">
                            <span
                                class="ripple absolute bg-white opacity-0 rounded-full scale-0
                                animate-ripple"></span>
                        </span>
                    </template>
                </button>

                @if ($errorMessage)
                    <div
                        class="mt-3 md:mt-4 p-2 md:p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-start text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-1 md:mr-2 mt-0.5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-medium">Oops!</p>
                            <p>{{ $errorMessage }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .animate-ripple {
            animation: ripple 0.6s linear;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</div>