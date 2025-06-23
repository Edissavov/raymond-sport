<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $address;
    public $phone;
    public $newPassword;
    public $newPasswordConfirmation;
    public $photo;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->phone = $user->phone;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'newPassword' => ['nullable', 'confirmed', Password::defaults()],
            'photo' => 'nullable|image|max:1024',
        ]);

        $user = Auth::user();

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
        ];

        if ($this->newPassword) {
            $updateData['password'] = bcrypt($this->newPassword);
        }

        $user->update($updateData);

        if ($this->photo) {
            $user->clearMediaCollection('profile-photos');
            $user->addMedia($this->photo->getRealPath())
                 ->toMediaCollection('profile-photos');
        }

        $this->dispatch('profile-updated');
        session()->flash('message', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}