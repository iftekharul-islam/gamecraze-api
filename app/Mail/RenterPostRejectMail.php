<?php

namespace App\Mail;

use App\Models\Game;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RenterPostRejectMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $rent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $rent)
    {
        $this->name = $name;
        $this->rent = $rent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $game = Game::find($this->rent->game_id);
        return $this->view('new_email.renter_post_reject_notification')
            ->subject('Gamehub rent post reject confirmation')
            ->with([
                'name' => $this->name,
                'reason' => $this->rent->reason,
                'game' => $game->name
            ]);
    }
}
