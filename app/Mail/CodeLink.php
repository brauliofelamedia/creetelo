<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class CodeLink extends Mailable
{
    use SerializesModels;

    public function __construct(private $code) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Se ha recibo una solicitud de inicio mágico',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.magic',
            with: [
                'code' => $this->code,
            ],
        );
    }
}
