<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

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
        $sessionCart = session()->get('cart', []);

        // Load product models for items in cart
        $this->cartItems = collect($sessionCart)->map(function ($item) {
            if (isset($item['product_id'])) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $item['product'] = $product;
                }
            }
            return $item;
        })->toArray();

        $this->calculateTotal();
    }

    public function increaseQuantity($key)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += 1;
            session()->put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cartUpdated');
        }
    }

    public function decreaseQuantity($key)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$key])) {
            if ($cart[$key]['quantity'] > 1) {
                $cart[$key]['quantity'] -= 1;
            }
            session()->put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cartUpdated');
        }
    }

    public function removeItem($key)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cartUpdated');
        }
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => $this->cartItems,
            'total' => $this->total
        ]);
    }
}