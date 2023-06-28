<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class EmailConfirmationMessage extends Mailable
{
    public string $purl_code;

    public function __construct(string $purl_code)
    {
        $this->purl_code = $purl_code;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Confirmation Message',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.email_confirm_message',
        );
    }
}
