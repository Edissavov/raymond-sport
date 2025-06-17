<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $categories;
    public $selectedCategory = null;
    public $products;

    public function mount()
    {
        $this->categories = Category::all();
        $this->loadProducts();
    }

    public function updatedSelectedCategory()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $query = Product::with('images');

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $this->products = $query->latest()->get();
    }
  
    public function render()
    {
        return view('livewire.products');
    }
}
