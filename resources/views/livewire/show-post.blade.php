<div class="container mx-auto px-4 py-8 max-w-4xl">
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover">
        @endif

        <div class="p-6 md:p-8">
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <span>
                    @if($post->published_at)
                        {{ $post->published_at->format('M d, Y') }}
                    @else
                        Draft
                    @endif
                </span>
                <span class="mx-2">•</span>
                <span>{{ $post->user->name ?? 'Unknown Author' }}</span>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>

            <div class="prose max-w-none">
                {!! Str::markdown($post->content) !!}
            </div>
        </div>
    </article>

    <div class="mt-8 flex justify-between">
        <a href="{{ route('blog.index') }}" class="flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Blog
        </a>
    </div>
</div>