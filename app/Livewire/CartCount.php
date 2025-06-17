<?php

namespace App\Livewire;

use Livewire\Component;

class CartCount extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $cart = session()->get('cart', []);
        $this->count = collect($cart)->sum('quantity');
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
