<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MailNotify extends Mailable {
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data) {
       $this->data = $data;
    }

    public function envelope(): Envelope {
        return new Envelope(
            from: new Address('besumicheal@gmail.com', 'Besufikad Micheal'),
            subject: 'Verification Code',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'emails.verification_code',
            with: [
                'data' => $this->data,
            ],
        );
    }

    public function attachments(): array {
        return [];
    }
}
