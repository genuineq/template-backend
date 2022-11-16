<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRecoverPasswordMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(private array $data)
    {
    }

    public function build(): static
    {
        return $this->subject('Reset password')
                    ->markdown('mails.send_recover_password')
                    ->with([
                        'requestName' => $this->data['name'],
                        'requestUrl' => $this->data['url']
                    ]);
    }
}
