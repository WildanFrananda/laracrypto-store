<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactPage extends Component {
    public string $name = '';

    public string $email = '';

    public string $message = '';

    public function submitForm(): void {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactFormSubmitted($validatedData));

        session()->flash('success', 'Your message has been sent successfully. We will contact you soon.');

        $this->reset();
    }

    public function render() {
        return view('livewire.contact-page')
            ->layout('layouts.app');
    }
}
