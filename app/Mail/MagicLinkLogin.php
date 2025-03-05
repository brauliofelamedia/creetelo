<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagicLinkLogin extends Mailable
{
    use SerializesModels;

    public function __construct(public string $token)
    {}

    public function build()
    {
        return $this->markdown('emails.magic-link')
                    ->subject('Tu enlace de acceso');
    }
}
