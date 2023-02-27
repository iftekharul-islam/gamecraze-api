<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $game_name, $game_link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($game_name, $game_link)
    {
        $this->game_name = $game_name;
        $this->game_link = $game_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.reminder_notification')
            ->subject('Game available for rent reminder')
            ->with([
                'game' => $this->game_name,
                'link' => $this->game_link,
            ]);

    }
}
