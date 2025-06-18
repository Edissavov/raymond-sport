<div
  class="relative min-h-screen w-full bg-black flex flex-col justify-center items-center text-white overflow-hidden"
  x-data="{ loaded: false }"
  x-init="setTimeout(() => loaded = true, 100)"
>
  <!-- Optimized background image with lazy loading -->
  <img
    src="https://raymond-sport.com/gallery/raymond-sklad-haskovo.jpg"
    alt="Raymond Fashion Showroom"
    class="absolute inset-0 w-full h-full object-cover object-center transition-opacity duration-500"
    :class="loaded ? 'opacity-40' : 'opacity-0'"
    loading="lazy"
  >

  <!-- Gradient overlay for better text contrast -->
  <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>

  <!-- Content -->
  <div class="relative z-10 text-center px-6 w-full max-w-4xl py-32 md:py-40">
    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4 md:mb-6 leading-tight tracking-tight">
      <span class="block" x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
             Твоят ритъм. Твоят стил. Твоят Raymond.
      </span>
    </h1>

    <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 max-w-2xl mx-auto opacity-90"
       x-transition:enter="transition ease-out duration-700 delay-100"
       x-transition:enter-start="opacity-0 translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0">
       Открий мъжки спортни екипи, които вървят в крак с теб.
    </p>

    <div x-transition:enter="transition ease-out duration-700 delay-200"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0">
      <a
        href="{{ route('products') }}"
        class="inline-block bg-white text-gray-900 px-8 py-3 md:px-10 md:py-4 rounded-full text-base md:text-lg font-semibold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl"
      >
        Пазарувай сега
      </a>
    </div>
  </div>


</div>