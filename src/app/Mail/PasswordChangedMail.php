<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function build(): static
    {
        return $this->subject('Password changed succesfully')
                    ->markdown('mails.password_changed');
    }
}
