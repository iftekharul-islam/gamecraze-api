<?php

namespace App\Mail;

use App\Models\Game;
use App\Models\GameOrder;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentSubOrderProcessingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $lend;
    /**
     * Create a new message instance.
     *
     * @return void
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

        return $this->view('new_email.sub_order_processing_notification')
            ->subject('Gamehub order is processing')
            ->with([
                'user' => $user->name,
                'order' => $order->order_no,
                'address' => $order->address,
                'game' => $game->name,
            ]);
    }
}
