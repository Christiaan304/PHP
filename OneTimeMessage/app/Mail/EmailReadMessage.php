<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class EmailReadMessage extends Mailable
{
    public string $purl_code;

    public function __construct(string $purl_code)
    {
        $this->purl_code = $purl_code;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Você recebeu uma One Time Message',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.email_read_message',
        );
    }
}
