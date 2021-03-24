<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;
    /**
     * SendPasswordResetCodeMail constructor.
     * @param $otp
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.reset_password_code')
            ->subject('Password Reset Code')
            ->with([
                'otp' => $this->otp,
            ]);
    }
}
