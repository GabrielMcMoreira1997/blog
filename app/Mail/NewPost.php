<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class NewPost extends Mailable
{
    use Queueable, SerializesModels;

    public $postTitle; // Variável para o título da postagem
    public $postSlug;  // Variável para o slug da postagem
    public $mail;
    public $mailEncode;
    public $imgHeader;

    /**
     * Create a new message instance.
     */
    public function __construct(Request $request, $mail, $imgHeader = null, $slug)
    {
        $this->postTitle = $request->title; // Extrai o título
        $this->postSlug = $slug;   // Extrai o slug (se o slug vier da request)
        $this->mail = $mail;
        $this->mailEncode = base64_encode($mail);
        $this->imgHeader = $imgHeader;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->postTitle, // Usa a propriedade dedicada para o assunto
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.new_post',
            with: [
                'title' => $this->postTitle, // Passa 'title' para a view
                'slug' => $this->postSlug,   // Passa 'slug' para a view
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}