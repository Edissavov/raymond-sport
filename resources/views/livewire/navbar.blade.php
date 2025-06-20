<div x-data="{
    lastScrollTop: 0,
    hidden: false,
    scrolled: false,
    dynamic: false,
    mobileMenuOpen: false,
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
    },
    closeMobileMenu() {
        this.mobileMenuOpen = false;
    }
}"
x-init="window.addEventListener('scroll', onScroll)"
>

<nav
    :class="{
        'bg-white/85 shadow-lg backdrop-blur-sm border-b border-black': scrolled,
        '-translate-y-full': hidden && dynamic,
        'translate-y-0 border-b border-black bg-white/60': !hidden || !dynamic
    }"
    class="fixed top-0 left-0 w-full transition-transform duration-300 z-50 flex items-center"
    style="height: 64px;"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex justify-between items-center w-full">
        <!-- Clickable Logo that redirects to home -->
        <a href="/" class="text-2xl font-extrabold text-gray-900 cursor-pointer select-none">
            Raymond
        </a>

        <!-- Desktop Navigation -->
        <ul class="hidden md:flex space-x-8 text-gray-700 font-semibold">
            <li>
                <a
                    href="{{ route('about-us') }}"
                    class="relative py-2 px-1 hover:text-blue-600 transition-colors"
                    @mouseenter="$el.querySelector('span').style.width = '100%'"
                    @mouseleave="$el.querySelector('span').style.width = '0'"
                >
                    За нас
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-0.5 bg-blue-600 transition-all duration-300"
                    ></span>
                </a>
            </li>
            <li class="flex items-center">@livewire('cart-count')</li>
        </ul>

        <!-- Mobile menu button -->
        <div class="md:hidden flex items-center">
            <div class="mr-4">@livewire('cart-count')</div>
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="text-gray-700 hover:text-blue-600 focus:outline-none"
            >
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div
        x-show="mobileMenuOpen"
        @click.away="closeMobileMenu"
        class="md:hidden absolute top-full left-0 w-full bg-white/80 shadow-lg border-b border-black"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
    >
        <ul class="px-4 py-3 space-y-4 text-gray-700 font-semibold">
            <li>
                <a
                    href="{{ route('about-us') }}"
                    class="block py-2 px-1 hover:text-blue-600 transition-colors"
                    @click="closeMobileMenu"
                >
                    За нас
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Spacer to push page content down initially -->
<div
    x-bind:style="(hidden && dynamic) ? 'height: 0px;' : 'height: 64px;'"
    class="transition-all duration-300"
></div>
</div>