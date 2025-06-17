<div x-data="{
        lastScrollTop: 0,
        hidden: false,
        scrolled: false,
        dynamic: false,
        navHeight: 64,
        onScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            this.dynamic = scrollTop > 20;
            this.scrolled = scrollTop > 50;

            if (this.dynamic) {
                if (scrollTop > this.lastScrollTop && scrollTop > 100) {
                    this.hidden = true;
                } else {
                    this.hidden = false;
                }
            } else {
                this.hidden = false;
            }

            this.lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }
    }"
    x-init="window.addEventListener('scroll', onScroll)"
>

    <nav
        :class="{
            'bg-amber-50/85 shadow-lg backdrop-blur-sm border-b border-black': scrolled,
            '-translate-y-full': hidden && dynamic,
            'translate-y-0 border-b border-black bg-amber-50/60': !hidden || !dynamic
        }"
        class="fixed top-0 left-0 w-full transition-transform duration-300 z-50 flex items-center"
        style="height: 64px;"
    >
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center w-full">
            <h1 class="text-2xl font-extrabold text-gray-900 cursor-pointer select-none">MenStyle</h1>
            <ul class="flex space-x-8 text-gray-700 font-semibold">
                <li>
                    <a
                        href="/"
                        class="relative py-2 px-1 hover:text-blue-600 transition-colors"
                        @mouseenter="$el.querySelector('span').style.width = '100%'"
                        @mouseleave="$el.querySelector('span').style.width = '0'"
                    >
                        Home
                        <span
                            class="absolute left-0 -bottom-1 w-0 h-0.5 bg-blue-600 transition-all duration-300"
                        ></span>
                    </a>
                </li>
                <li>
                    <a
                        href="/products"
                        class="relative py-2 px-1 hover:text-blue-600 transition-colors"
                        @mouseenter="$el.querySelector('span').style.width = '100%'"
                        @mouseleave="$el.querySelector('span').style.width = '0'"
                    >
                        Shop
                        <span
                            class="absolute left-0 -bottom-1 w-0 h-0.5 bg-blue-600 transition-all duration-300"
                        ></span>
                    </a>
                </li>
                <li class="flex items-center">@livewire('cart-count')</li>
            </ul>
        </div>
    </nav>

    <!-- Spacer to push page content down initially -->
    <div
        x-bind:style="(hidden && dynamic) ? 'height: 0px;' : 'height: 64px;'"
        class="transition-all duration-300"
    ></div>

</div>
