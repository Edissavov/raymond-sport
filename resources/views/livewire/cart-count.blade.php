<a href="{{ route('cart') }}" class="relative inline-flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-9-9v9m0-9H9m6 0h-3" />
    </svg>

    <span class="absolute -top-2 -right-2 w-5 h-5 flex items-center justify-center
                {{ $count > 0 ? 'bg-red-600 text-white' : 'bg-transparent text-transparent' }}
                text-xs rounded-full transition-colors duration-200">
        {{ $count > 0 ? $count : '0' }}
    </span>
</a>