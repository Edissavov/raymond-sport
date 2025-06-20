<?php

namespace App\Livewire;

use Livewire\Component;

class Faq extends Component
{
    public $activeQuestion = null;

    public function toggleQuestion($questionId)
    {
        $this->activeQuestion = $this->activeQuestion === $questionId ? null : $questionId;
    }

    public function render()
    {
        return view('livewire.faq');
    }
}
