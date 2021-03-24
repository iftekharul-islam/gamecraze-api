<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRenterNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $gameName;

    /**
     * RenterNotification constructor.
     * @param $gameName
     */
    public function __construct($gameName)
    {
        $this->gameName = $gameName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.render_notification')
            ->subject('Gamehub Rent Confirmation')
            ->with([
                'game' => $this->gameName,
            ]);
    }
}
