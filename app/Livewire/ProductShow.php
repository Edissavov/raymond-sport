<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    public Product $product;
    public $errorMessage = null;

    public $showCartNotification = false;
    public $selectedSizeId = null;

    public function mount($slug)
    {
        $this->product = Product::with(['category', 'productSizes.size', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function selectSize($sizeId)
    {
        $ps = $this->product->productSizes->firstWhere('size.id', $sizeId);

        if ($ps && $ps->stock > 0) {
            $this->selectedSizeId = $sizeId;
        }
    }

    public function addToCart()
    {
        if (is_null($this->selectedSizeId)) {
            $this->errorMessage = 'Please select a size first.';
            return;
        }

        $this->errorMessage = null;

        $cart = session()->get('cart', []);

        $key = $this->product->id . '-' . $this->selectedSizeId;

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $size = $this->product->productSizes->where('size_id', $this->selectedSizeId)->first();

            $cart[$key] = [
                'product_id' => $this->product->id,
                'name'       => $this->product->name,
                'price'      => $this->product->price,
                'size_id'    => $this->selectedSizeId,
                'size_name'  => $size?->size->name ?? '',
                'quantity'   => 1,
            ];
        }

        session()->put('cart', $cart);
        session()->flash('success', 'Added to cart!');
        $this->showCartNotification = true;
        $this->dispatch('cartUpdated');
        $this->dispatch('notify', duration: 3000);
    }

    public function render()
    {
        return view('livewire.product-show');
    }
}