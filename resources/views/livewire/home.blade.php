<div class="min-h-screen bg-white">
    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <div class="relative h-screen w-full overflow-hidden">
            <!-- Background Image -->
            <img src="https://raymond-sport.com/gallery/raymond-sklad-haskovo.jpg" alt="Raymond Sport Collection"
                class="absolute inset-0 w-full h-full object-cover object-center" loading="lazy" x-data="{
                    loaded: false,
                    parallax() {
                        const speed = 0.3;
                        const scrollPosition = window.pageYOffset;
                        const position = scrollPosition * speed;
                        this.$el.style.transform = `translateY(${position}px)`;
                    }
                }"
                x-init="setTimeout(() => loaded = true, 100);
                window.addEventListener('scroll', () => parallax());"
                :class="{
                    'opacity-100': loaded,
                    'opacity-0 scale-110': !loaded
                }">

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/30 to-black/50"></div>

            <!-- Content -->
            <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-6">
                <!-- Animated Heading -->
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6 leading-tight tracking-tight"
                    x-data="{
                        text: 'Твоят ритъм. Твоят стил.',
                        displayedText: '',
                        index: 0,
                        show: false,
                        init() {
                            this.show = true;
                            this.typeText();
                        },
                        typeText() {
                            if (this.index < this.text.length) {
                                this.displayedText += this.text.charAt(this.index);
                                this.index++;
                                setTimeout(() => this.typeText(), 100);
                            }
                        }
                    }" x-init="init()" x-show="show"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 translate-y-0"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <span x-text="displayedText"></span>
                    <span class="inline-block w-1 h-12 bg-white animate-pulse" x-show="index <= text.length"></span>
                </h1>
                <!-- Subheading -->
                <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto" x-data="{ show: false }"
                    x-init="setTimeout(() => show = true, 800)" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Висококачествени спортни екипи, създадени за твоята активност
                </p>

                <!-- CTA Button -->
                <a href="{{ route('products') }}"
                    class="px-8 py-3 bg-white text-black rounded-full text-lg font-semibold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg relative overflow-hidden group"
                    x-data="{ show: false }" x-init="setTimeout(() => show = true, 1200)" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-600"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <span class="relative z-10">Пазарувай сега</span>
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 -translate-x-full group-hover:translate-x-full"></span>
                </a>
            </div>



        <!-- Scrolling Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10" x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 1800)" x-transition:enter="transition ease-out duration-1000 delay-900"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-show="show">
            <div class="animate-bounce w-8 h-8 border-4 border-white rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Categories Section - 2 per row -->
    <div class="max-w-7xl mx-auto px-6 py-16 sm:py-24">
        {{-- <div class="text-center mb-12" x-data="{ show: false }" x-intersect.once="show = true">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"
                x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0" x-show="show">Нашите Категории</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto"
                x-transition:enter="transition ease-out duration-700 delay-100"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-show="show">Открийте перфектния спортен екип за вашите нужди</p>
        </div> --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8" x-data="{
            items: {{ $categories->count() }},
            show: Array({{ $categories->count() }}).fill(false)
        }"
            x-intersect.once="
                for(let i = 0; i < items; i++) {
                    setTimeout(() => show[i] = true, i * 100);
                }
             ">
            @foreach ($categories as $index => $category)
                @php
                    $exampleProduct = $category->products->first();
                @endphp

                <a href="{{ route('products.category', $category->slug) }}"
                    class="group block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 transform">
                    <div class="relative aspect-square overflow-hidden">
                        @if ($exampleProduct && $exampleProduct->getFirstMediaUrl('product_images'))
                            <img src="{{ $exampleProduct->getFirstMediaUrl('product_images') }}"
                                alt="{{ $category->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                loading="lazy">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white text-left">
                            <h3 class="text-xl font-bold p-4">{{ $category->name }}</h3>

                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
