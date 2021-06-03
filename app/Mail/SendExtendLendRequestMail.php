<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendExtendLendRequestMail extends Mailable
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
        return $this->view('new_email.lend_extend_request_to_admin')
            ->subject('New lend extend request available')
            ->with([
                'order_no' => $this->lend->order->order_no,
            ]);
    }
}
