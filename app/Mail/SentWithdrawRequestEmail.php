<?php

namespace App\Mail;

use App\Models\WithdrawRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentWithdrawRequestEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $withdraw;

    /**
     * Create a new message instance.
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
        $request = WithdrawRequest::with('user')->where('id', $this->withdraw->id)->first();
        return $this->view('new_email.withdraw_request_to_admin')
            ->subject('New Withdraw request available')
            ->with([
                'user_name' => $request->user->name,
                'user_id' => $request->user->id,
                'amount' => $request->amount,
                'phone_no' => $request->user->phone_number,
                'email' => $request->user->email
            ]);
    }
}
