<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatedOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $renter;
    public $order;
    public $gameNames;

    /**
     * CreatedOrderMail constructor.
     * @param $renter
     * @param $order
     * @param $gameNames
     */
    public function __construct($renter, $order, $gameNames)
    {
        $this->renter = $renter;
        $this->order = $order;
        $this->gameNames = $gameNames;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.order_created_notification_to_admin')
            ->subject('Rent Complete Reminder')
            ->with([
                'games' => implode(', ', $this->gameNames),
                'order' => $this->order,
                'customer' => $this->renter->name,
            ]);
    }
}
