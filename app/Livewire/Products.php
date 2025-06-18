<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{

    public $categories;
    public $products;
    public $currentCategorySlug = null;

    public function mount($category = null)
    {
        $this->categories = Category::all();
        $this->currentCategorySlug = $category instanceof \App\Models\Category
            ? $category->slug
            : $category;

        $this->loadProducts();
    }

    protected function loadProducts()
    {
        $this->products = Product::query()
            ->with(['images', 'category'])
            ->when($this->currentCategorySlug, function($query) {
                $query->whereHas('category', function($q) {
                    $q->where('slug', $this->currentCategorySlug);
                });
            })
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.products');
    }
}