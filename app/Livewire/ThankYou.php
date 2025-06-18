<?php

namespace App\Livewire;

use Livewire\Component;

class ThankYou extends Component
{
    public $order;

    public function mount()
    {
        $this->order = session()->get('order');

        if (!$this->order) {
            return redirect()->route('home');
        }

        // Clear the order from session after displaying
        session()->forget('order');
    }

    public function render()
    {
        return view('livewire.thank-you', [
            'order' => $this->order
        ]);
    }
}