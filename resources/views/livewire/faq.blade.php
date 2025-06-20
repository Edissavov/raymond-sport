<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
     x-data="{ localActive: $wire.entangle('activeQuestion') }">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Често задавани въпроси</h1>
        <p class="text-lg text-gray-600">Намери отговори на най-често задаваните въпроси</p>
    </div>

    <div class="space-y-4">
        <!-- Delivery Questions -->
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button
                @click="localActive = localActive === 'delivery' ? null : 'delivery'"
                class="w-full px-6 py-4 bg-gray-50 text-left font-medium text-gray-900 flex justify-between items-center"
            >
                <span>Доставка и срокове</span>
                <svg
                    :class="{ 'rotate-180': localActive === 'delivery' }"
                    class="h-5 w-5 text-gray-500 transition-transform duration-200"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="localActive === 'delivery'" x-collapse class="px-6 py-4 bg-white">
                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-900">Какви са начините на доставка?</h3>
                        <p class="mt-1 text-gray-600">
                            Работим с Еконт и Спиди. Можете да изберете предпочитан от вас куриер при направата на поръчката.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Колко време отнема обработката на поръчка?</h3>
                        <p class="mt-1 text-gray-600">
                            Обработваме поръчките в рамките на 1 работен ден. Доставката обикновено отнема 1-3 работни дни след изпращането.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Има ли възможност за личен преглед на стоките?</h3>
                        <p class="mt-1 text-gray-600">
                            Да, може да посетите нашия офис в Хасково след предварителна уговорка на телефон 0889 210 781.
                        </p>
                    </div>
                </div>
            </div>
        </div>




        <!-- Product Questions -->
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <button
                @click="localActive = localActive === 'products' ? null : 'products'"
                class="w-full px-6 py-4 bg-gray-50 text-left font-medium text-gray-900 flex justify-between items-center"
            >
                <span>Продукти и гаранции</span>
                <svg
                    :class="{ 'rotate-180': localActive === 'products' }"
                    class="h-5 w-5 text-gray-500 transition-transform duration-200"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="localActive === 'products'" x-collapse class="px-6 py-4 bg-white">
                <div class="space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-900">Имате ли размерни таблици?</h3>
                        <p class="mt-1 text-gray-600">
                            Да, за всеки продукт имаме подробна размерна таблица, която можете да видите на страницата на продукта.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Каква гаранция предлагате?</h3>
                        <p class="mt-1 text-gray-600">
                            Всички наши продукти имат гаранция според изискванията на производителя. Обикновено това е 2 години за производствени дефекти.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Still have questions -->

</div>