<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->calculateTotal();
    }

    public function increaseQuantity($key)
    {
        $cart = session()->get('cart', []);
        $cart[$key]['quantity'] += 1;
        session()->put('cart', $cart);
        $this->loadCart();
    }

    public function decreaseQuantity($key)
    {
        $cart = session()->get('cart', []);
        if ($cart[$key]['quantity'] > 1) {
            $cart[$key]['quantity'] -= 1;
        }
        session()->put('cart', $cart);
        $this->loadCart();
    }

    public function removeItem($key)
    {
        $cart = session()->get('cart', []);
        unset($cart[$key]);
        session()->put('cart', $cart);
        $this->loadCart();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
