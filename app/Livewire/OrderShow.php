<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrderShow extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->order = $order->load([
            'items.product.media',
            'items.size',
            'user'
        ]);
    }

    public function render()
    {
        return view('livewire.order-show');
    }
}