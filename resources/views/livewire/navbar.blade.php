<div x-data="{
    lastScrollTop: 0,
    hidden: false,
    scrolled: false,
    dynamic: false,
    mobileMenuOpen: false,
    profileDropdownOpen: false,
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
    },
    toggleProfileDropdown() {
        this.profileDropdownOpen = !this.profileDropdownOpen;
    },
    closeProfileDropdown() {
        this.profileDropdownOpen = false;
    }
}"
x-init="window.addEventListener('scroll', onScroll)"
>

<nav
    :class="{
        'bg-white/90 shadow-md backdrop-blur-sm border-b border-gray-200': scrolled,
        '-translate-y-full': hidden && dynamic,
        'translate-y-0 border-b border-gray-200 bg-white/80': !hidden || !dynamic
    }"
    class="fixed top-0 left-0 w-full transition-transform duration-300 z-50 flex items-center"
    style="height: 64px;"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex justify-between items-center w-full">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-gray-800 cursor-pointer select-none flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <span class="hidden sm:inline">Raymond</span>
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-4">
            <!-- Navigation Links Group -->
            <div class="flex items-center space-x-2">
                <a
                    href="{{ route('blog.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition-colors font-medium px-3 py-2 rounded-md flex items-center"
                    :class="{'text-blue-600': route().current('blog.index')}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Блог
                </a>
                <a
                    href="{{ route('about-us') }}"
                    class="text-gray-700 hover:text-blue-600 transition-colors font-medium px-3 py-2 rounded-md"
                    :class="{'text-blue-600': route().current('about-us')}"
                >
                    За нас
                </a>
                <a
                    href="{{ route('contact-us') }}"
                    class="text-gray-700 hover:text-blue-600 transition-colors font-medium px-3 py-2 rounded-md"
                    :class="{'text-blue-600': route().current('contact-us')}"
                >
                    Контакти
                </a>
            </div>

            <!-- Cart and Profile Group -->
            <div class="flex items-center space-x-2 ml-2">
                <!-- Cart -->
                <div class="relative">
                    @livewire('cart-count')
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data @click.away="closeProfileDropdown">
                    <button
                        @click="toggleProfileDropdown"
                        class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none transition-colors"
                    >
                        <div class="w-9 h-9 rounded-full pb-1 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </button>

                    <!-- Dropdown menu -->
                    <div
                        x-show="profileDropdownOpen"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none py-1 z-50"
                    >
                        @auth
                            <a
                                href="{{ route('profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                @click="closeProfileDropdown"
                            >
                                Профил
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    @click="closeProfileDropdown"
                                >
                                    Изход
                                </button>
                            </form>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                @click="closeProfileDropdown"
                            >
                                Вход
                            </a>
                            <a
                                href="{{ route('register') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                @click="closeProfileDropdown"
                            >
                                Регистрация
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

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
        class="md:hidden absolute top-full left-0 w-full bg-white shadow-lg border-b border-gray-200"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
    >
        <div class="px-4 py-3 space-y-2">
            <a
                href="{{ route('blog.index') }}"
                class="flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 transition-colors"
                :class="{'text-blue-600 bg-blue-50': route().current('blog.index')}"
                @click="closeMobileMenu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                Блог
            </a>
            <a
                href="{{ route('about-us') }}"
                class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 transition-colors"
                :class="{'text-blue-600 bg-blue-50': route().current('about-us')}"
                @click="closeMobileMenu"
            >
                За нас
            </a>
            <a
                href="{{ route('contact-us') }}"
                class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 transition-colors"
                :class="{'text-blue-600 bg-blue-50': route().current('contact-us')}"
                @click="closeMobileMenu"
            >
                Контакти
            </a>
            <div class="border-t border-gray-200 my-2"></div>
            @auth
                <a
                    href="{{ route('profile') }}"
                    class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 transition-colors"
                    @click="closeMobileMenu"
                >
                    Профил
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="block w-full text-left py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 transition-colors"
                        @click="closeMobileMenu"
                    >
                        Изход
                    </button>
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 transition-colors"
                    @click="closeMobileMenu"
                >
                    Вход
                </a>
                <a
                    href="{{ route('register') }}"
                    class="block py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 transition-colors"
                    @click="closeMobileMenu"
                >
                    Регистрация
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Spacer to push page content down initially -->
<div
    x-bind:style="(hidden && dynamic) ? 'height: 0px;' : 'height: 64px;'"
    class="transition-all duration-300"
></div>
</div>
