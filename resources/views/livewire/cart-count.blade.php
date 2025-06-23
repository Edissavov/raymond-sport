<a href="{{ route('cart') }}" class="relative inline-flex items-center justify-center text-gray-700 hover:text-blue-600 transition-colors">
    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-5 w-5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-9-9v9m0-9H9m6 0h-3" />
    </svg>
    @if($count > 0)
        <span class="absolute -top-2 -right-2 w-5 h-5 flex items-center justify-center bg-red-600 text-white text-xs rounded-full">
            {{ $count }}
        </span>
    @endif
</a>