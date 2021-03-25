<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RenterPostAcceptMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $game;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $game)
    {
        $this->name = $name;
        $this->game = $game;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.renter_post_accept_notification')
            ->subject('Gamehub rent post approve confirmation')
            ->with([
                'name' => $this->name,
                'game' => $this->game,
            ]);
    }
}
