<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable {
    use Queueable, SerializesModels;

    public function __construct(
        public readonly array $formData
    ) {}

    public function envelope(): Envelope {
        return new Envelope(
            from: $this->formData['email'],
            subject: 'New Contact Form Submission',
        );
    }

    public function content(): Content {
        return new Content(
            markdown: 'emails.contact.submitted',
        );
    }

    public function attachments(): array {
        return [];
    }
}
