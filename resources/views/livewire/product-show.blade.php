<div class="max-w-7xl mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        {{-- product Image --}}
        <div>

            <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                class="rounded-lg shadow w-full object-cover max-h-[600px]">

        </div>

        {{-- product Details --}}
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-gray-600 mb-1">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="text-xl font-semibold text-green-700 mb-4">${{ number_format($product->price, 2) }}</p>

            <p class="mb-4 text-gray-700">{{ $product->description }}</p>

            {{-- Size Selection --}}


            <ul class="grid grid-cols-3 gap-3 mb-6">
                @foreach ($product->productSizes as $ps)
                  <li>
                    <input
                      type="radio"
                      id="size-{{ $ps->size_id }}"
                      name="size"
                      class="peer hidden"
                      value="{{ $ps->size_id }}"
                      wire:model="selectedSizeId"
                      @if($ps->stock <= 0) disabled @endif
                    />
                    <label
                      for="size-{{ $ps->size_id }}"
                      class="block cursor-pointer select-none rounded-lg border px-4 py-3 text-center text-sm
                        peer-checked:ring-2 peer-checked:ring-black
                        {{ $ps->stock > 0 ? 'bg-white hover:bg-gray-100 text-gray-900' : 'bg-gray-200 text-gray-400 cursor-not-allowed' }}
                        disabled:cursor-help disabled:bg-gray-200 disabled:text-gray-400"
                      aria-disabled="{{ $ps->stock <= 0 ? 'true' : 'false' }}"
                    >
                      <span class="font-semibold block">{{ $ps->size->name }}</span>
                      <span class="text-xs mt-1 block">
                        {{ $ps->stock > 0 ? $ps->stock . ' in stock' : 'Out of stock' }}
                      </span>
                    </label>
                  </li>
                @endforeach
              </ul>


{{-- Add to Cart Button --}}
<button
    wire:click="addToCart"
    @if (is_null($selectedSizeId))  @endif
    class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition
           disabled:opacity-50 "
>
    Add to cart
</button>

{{-- Error Message --}}
@if ($errorMessage)
    <p class="mt-2 text-red-600 text-sm">{{ $errorMessage }}</p>
@endif

{{-- Flash Message --}}
@if (session()->has('success'))
    <p class="mt-2 text-green-600 text-sm">{{ session('success') }}</p>
@endif


    </div>
</div>
</div>