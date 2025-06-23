<!-- resources/views/livewire/blog-posts.blade.php -->
<div x-data="{ searchOpen: false }" class="container mx-auto px-4 py-8">
    <!-- Search and Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Our Blog</h1>

        <div class="relative w-full md:w-64">
            <button @click="searchOpen = !searchOpen" class="md:hidden w-full flex items-center justify-between px-4 py-2 bg-white border border-gray-300 rounded-lg">
                <span>Search</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="searchOpen || !('ontouchstart' in window)" x-transition class="w-full">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search posts..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                >
            </div>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                @if($post->featured_image)
                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <span>{{ $post->published_at?->format('M d, Y') ?? 'Draft' }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $post->user->name ?? 'Unknown Author' }}</span>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <!-- Changed from posts.show to blog.show -->
                        <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-600 mb-4">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 150) }}</p>
                    <!-- Changed from posts.show to blog.show -->
                    <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        Read more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Load More Button -->
    @if($posts->hasMorePages())
        <div class="mt-8 text-center">
            <button
                wire:click="loadMore"
                wire:loading.attr="disabled"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 transition"
            >
                <span wire:loading.remove>Load More</span>
                <span wire:loading>Loading...</span>
            </button>
        </div>
    @endif
</div>