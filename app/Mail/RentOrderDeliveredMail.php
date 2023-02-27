<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentOrderDeliveredMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $name)
    {
        $this->order = $order;
        $this->name = $name;
    }

    /**
     * Build the message.

     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.order_delivered_notification')
            ->subject('Gamehub order is delivered')
            ->with([
                'name' => $this->name,
                'order' => $this->order,
            ]);
    }

}
