<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-4xl font-extrabold mb-8 text-gray-900">Our Products</h2>

    {{-- Category Filter --}}
    <div class="mb-8">
        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Filter by Category</label>
        <select 
            wire:model="selectedCategory" 
            id="category" 
            class="border border-gray-300 rounded-lg px-4 py-3 w-full md:w-1/3 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
        >
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse ($products as $product)
            <a href="{{ route('product-show', $product->slug) }}">
            <div
                class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transform hover:-translate-y-1 transition duration-300"
            >
                <img
                    src="{{ $product->getFirstMediaUrl('product_images') }}" 
                    alt="{{ $product->name }}"
                    class="w-full h-64 object-cover"
                    loading="lazy"
                >
                <div class="p-6 flex flex-col justify-between h-48">
                  
                        <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition-colors">
                            {{ $product->name }}
                        </h3>
                    

                    <p class="mt-2 text-blue-600 font-bold text-xl">
                        ${{ number_format($product->price, 2) }}
                    </p>
                </div>
            </div>
            </a>
        @empty
            <p class="col-span-4 text-gray-500 text-center text-lg">No products found.</p>
        @endforelse
    </div>
</div>
