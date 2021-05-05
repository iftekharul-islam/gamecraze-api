<?php

namespace App\Mail;

use App\Models\Game;
use App\Models\GameOrder;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentSubOrderPostponedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $lend;

    /**
     * RentSubOrderPostponedMail constructor.
     * @param $lend
     */
    public function __construct($lend)
    {
        $this->lend = $lend;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = GameOrder::find($this->lend->game_order_id);
        $rent = Rent::find($this->lend->rent_id);
        $game = Game::find($rent->game_id);
        $user = User::find($this->lend->lender_id);

        return $this->view('new_email.sub_order_postponed_notification')
            ->subject('Gamehub order is postponed')
            ->with([
                'user' => $user->name,
                'order' => $order->order_no,
                'address' => $order->address,
                'game' => $game->name,
            ]);
    }
}
