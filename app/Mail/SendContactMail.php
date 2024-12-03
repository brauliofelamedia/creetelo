<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private $data)
    {
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Se ha recibido una solicitud de contacto',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'name' => $this->data->name,
                'email' => $this->data->email,
                'phone' => $this->data->phone,
                'comments' => $this->data->comments,
            ],
        );
    }
}
