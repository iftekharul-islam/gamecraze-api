<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellPostRejectedEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $product;
    public $user;

    /**
     * SellPostRejectedEmail constructor.
     * @param $product
     * @param $user
     */
    public function __construct($product, $user)
    {
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.sell_post_reject_notification')
            ->subject('Gamehub sell post rejected')
            ->with([
                'user' => $this->user,
                'product' =>  $this->product->product_no,
            ]);
    }
}
