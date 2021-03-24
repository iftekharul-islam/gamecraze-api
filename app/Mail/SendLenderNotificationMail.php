<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLenderNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $gameNames;

    /**
     * LenderNotification constructor.
     * @param $gameNames
     */
    public function __construct($gameNames)
    {
        $this->gameNames = $gameNames;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.lender_notification')
            ->subject('Gamehub Lend Confirmation')
            ->with([
                'games' => implode(", ", $this->gameNames),
            ]);
    }
}
