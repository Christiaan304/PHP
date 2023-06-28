<?php

namespace App\Mail;

use DateTime;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class EmailMessageReaded extends Mailable
{
    public DateTime $datetime_readed;
    public string $recipient_email;

    public function __construct(DateTime $datetime_readed, string $recipient_email)
    {
        $this->datetime_readed = $datetime_readed;
        $this->recipient_email = $recipient_email;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'A Menssagem foi lida por - ' . $this->recipient_email,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.email_message_readed',
        );
    }
}
