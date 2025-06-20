<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Home extends Component
{
    public $categories;

    public function mount()
    {
        // Load categories with their first product (for the example image)
        $this->categories = Category::with(['products' => function($query) {
            $query->with('media')->orderBy('created_at', 'desc')->take(1);
        }])->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}