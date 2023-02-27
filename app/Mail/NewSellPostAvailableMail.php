<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSellPostAvailableMail extends Mailable
{
    use Queueable, SerializesModels;
    public $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $product = Product::with('user')->where('id', $this->product->id)->first();
        return $this->view('new_email.new_sell_post_notification_to_admin')
            ->subject('New sell post available')
            ->with([
                'product_no' => $product->product_no,
                'user' => $product->user->name
            ]);
    }
}
