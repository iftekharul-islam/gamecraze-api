<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentWithdrawRequestApprovedEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $withdraw;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($withdraw)
    {
        $this->withdraw = $withdraw;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.withdraw_request_approved')
            ->subject('Withdraw request Approved')
            ->with([
                'name' => $this->withdraw->user->name,
                'amount' => $this->withdraw->amount
            ]);
    }
}
