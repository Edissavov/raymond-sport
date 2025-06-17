<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public $cart = [];
    public $total = 0;
    public $shippingAddress;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
    }

    public function placeOrder()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'total_price' => $this->total,
                'shipping_address' => $this->shippingAddress,
            ]);

            foreach ($this->cart as $item) {
                // Check stock again
                $ps = DB::table('product_size')
                    ->where('product_id', $item['product_id'])
                    ->where('size_id', $item['size_id'])
                    ->lockForUpdate()
                    ->first();

                if (!$ps || $ps->stock < $item['quantity']) {
                    DB::rollBack();
                    session()->flash('error', "Not enough stock for {$item['name']} ({$item['size_name']}).");
                    return;
                }

                // Create OrderItem
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'size_id'    => $item['size_id'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                ]);

                // Decrease stock
                DB::table('product_size')
                    ->where('product_id', $item['product_id'])
                    ->where('size_id', $item['size_id'])
                    ->decrement('stock', $item['quantity']);
            }

            DB::commit();

            session()->forget('cart');
            session()->put('order', [
               'shipping_address'=> $this->shippingAddress
            ]);
            session()->flash('success', 'Order placed successfully!');

            return $this->redirect(route('thank-you'));

        } catch (\Exception $e) {
            

            // Optional: show actual error in UI (remove this on production)
            session()->flash('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
