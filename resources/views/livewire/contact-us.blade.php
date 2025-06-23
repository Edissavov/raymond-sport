<div x-data="{
    showSuccess: @entangle('success'),
    isSubmitting: @entangle('isSubmitting'),
    init() {
        if (this.showSuccess) {
            setTimeout(() => {
                this.showSuccess = false;
                this.$wire.set('success', false);
            }, 5000);
        }
    }
}"
x-init="init()"
class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
>
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Свържете се с нас
            </h1>
            <p class="mt-4 text-lg text-gray-500">
                Имате въпроси или нужда от помощ? Изпратете ни съобщение и ние ще ви отговорим възможно най-бързо.
            </p>
        </div>

        <!-- Success Message -->
        <div
            x-show="showSuccess"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="rounded-md bg-green-50 p-4 mb-6"
        >
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        Благодарим ви за съобщението! Ще се свържем с вас възможно най-скоро.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form wire:submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Name -->
                        <div class="sm:col-span-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">Име *</label>
                            <div class="mt-1">
                                <input
                                    wire:model.defer="name"
                                    type="text"
                                    id="name"
                                    autocomplete="name"
                                    class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                                >
                                @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="sm:col-span-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">Имейл *</label>
                            <div class="mt-1">
                                <input
                                    wire:model.defer="email"
                                    type="email"
                                    id="email"
                                    autocomplete="email"
                                    class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                                >
                                @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="sm:col-span-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                            <div class="mt-1">
                                <input
                                    wire:model.defer="phone"
                                    type="tel"
                                    id="phone"
                                    autocomplete="tel"
                                    class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                                >
                                @error('phone') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="sm:col-span-2">
                            <label for="subject" class="block text-sm font-medium text-gray-700">Тема *</label>
                            <div class="mt-1">
                                <input
                                    wire:model.defer="subject"
                                    type="text"
                                    id="subject"
                                    class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                                >
                                @error('subject') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="sm:col-span-2">
                            <label for="message" class="block text-sm font-medium text-gray-700">Съобщение *</label>
                            <div class="mt-1">
                                <textarea
                                    wire:model.defer="message"
                                    id="message"
                                    rows="4"
                                    class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md"
                                ></textarea>
                                @error('message') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="ml-3 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg
                                x-show="isSubmitting"
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-show="!isSubmitting">Изпрати съобщение</span>
                            <span x-show="isSubmitting">Изпращане...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Телефон
                            </dt>
                            <dd class="flex items-baseline">
                                <p class="text-lg font-semibold text-gray-900">
                                    +359 123 456 789
                                </p>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 min-w-0 flex-1 overflow-visible">
                            <dt class="text-sm font-medium text-gray-500">
                                Имейл
                            </dt>
                            <dd class="flex items-baseline">
                                <a href="mailto:edimeli123@gmail.com"
                                   class="text-lg font-semibold text-blue-600 hover:text-blue-800 hover:underline break-all">  <!-- Changed here -->
                                    edimeli123@gmail.com

                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Адрес
                            </dt>
                            <dd class="flex items-baseline">
                                <p class="text-lg font-semibold text-gray-900">
                                    ул. Бадема 20, Хасково
                                </p>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>