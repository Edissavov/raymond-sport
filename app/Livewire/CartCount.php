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
        $this->count = collect(session()->get('cart', []))->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
