<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On; // Add this for event handling if needed

class Checkout extends Component
{
    public $cart = [];
    public $total = 0;
    public $shippingAddress;
    public $phoneNumber;
    public $deliveryOption;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function placeOrder()
    {
        $this->validate([
            'shippingAddress' => 'required|min:2',
            'phoneNumber' => 'required|min:6',
            'deliveryOption' => 'required|in:econt,speedy'
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $this->total,
                'shipping_address' => $this->shippingAddress,
                'phone_number' => $this->phoneNumber,
                'delivery_option' => $this->deliveryOption,
                'status' => 'pending'
            ]);

            foreach ($this->cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => auth()->id(),
                    'product_id' => $item['product_id'],
                    'size_id' => $item['size_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            // Store the order in session before redirecting
            session()->put('order', $order);
            session()->forget('cart');

            return redirect()->route('thank-you');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Order failed: '.$e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.checkout');
    }
}
