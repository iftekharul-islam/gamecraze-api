<?php

namespace App\Mail;

use App\Models\Lender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendExtendLendConfirmMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $game;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $game)
    {
        $this->user = $user;
        $this->game = $game;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.extend_request_approved')
            ->subject('Extend request Approved')
            ->with([
                'name' => $this->user,
                'game' => $this->game
            ]);
    }
}
