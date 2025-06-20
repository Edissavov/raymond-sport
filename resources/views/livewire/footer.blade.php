<footer class="bg-gray-100 border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Реймонд Спорт</h3>
                <p class="text-gray-600 mb-4">Качествени спортни дрехи от 1994 г.</p>
                <p class="text-gray-600">Хасково, България</p>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Обслужване на клиенти</h3>
                <ul class="space-y-2">
                    {{-- <li><a href="{{ route('contact') }}" class="text-gray-600 hover:text-black transition">Контакти</a></li>
                    <li><a href="{{ route('shipping') }}" class="text-gray-600 hover:text-black transition">Доставка</a></li>
                    <li><a href="{{ route('returns') }}" class="text-gray-600 hover:text-black transition">Връщане и рекламации</a></li> --}}
                    <li><a href="{{ route('faq') }}" class="text-gray-600 hover:text-black transition">Често задавани въпроси</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Правна информация</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('terms') }}" class="text-gray-600 hover:text-black transition">Общи
                            условия</a></li>
                    {{-- <li><a href="{{ route('privacy') }}" class="text-gray-600 hover:text-black transition">Политика за поверителност</a></li>
                    <li><a href="{{ route('cookie-policy') }}" class="text-gray-600 hover:text-black transition">Политика за бисквитки</a></li> --}}
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-200 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm mb-4 md:mb-0">© 2025 Реймонд Спорт. Всички права запазени.</p>

            <div class="flex space-x-6">
                <a href="https://www.facebook.com/raymondsport" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd" />
                    </svg>
                </a>

            </div>
        </div>
    </div>
</footer>
