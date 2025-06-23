<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class OrderHistory extends Component
{
    use WithPagination;

    public $perPage = 5;

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function render()
    {
        $orders = Auth::user()->orders()
            ->with(['items.product.media', 'items.size'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.order-history', [
            'orders' => $orders
        ]);
    }
}