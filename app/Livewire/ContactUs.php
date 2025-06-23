<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactMessage;

class ContactUs extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';
    public $success = false;
    public $isSubmitting = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'subject' => 'required|min:3',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->isSubmitting = true;
        $this->validate();

        // Save to database
        $contact = ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        // Send email
        Mail::to(config('mail.contact_to'))->send(new ContactFormSubmitted($contact));

        $this->resetForm();
        $this->success = true;
        $this->isSubmitting = false;
    }

    private function resetForm()
    {
        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}
