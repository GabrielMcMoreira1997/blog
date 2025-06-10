<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $emailEncode; // Add this property

    /**
     * Create a new message instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
        $this->emailEncode = base64_encode($email); // Encode the email here
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmação de Inscrição na Newsletter',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.register',
            with: [
                'email' => $this->email,
                'emailEncode' => $this->emailEncode, // Pass the encoded email to the view
            ]
        );
    }

    // ... rest of your Mailable methods
}