<?php

namespace App\Livewire;

use Livewire\Component;

class ThankYou extends Component
{
    public $orderInfo;
    public function mount(){
        $this->orderInfo = session()->get('order', []);
        session()->forget(keys: 'order');
    }

    public function render()
    {
        return view('livewire.thank-you');
    }
}
