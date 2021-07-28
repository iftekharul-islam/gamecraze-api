<?php

namespace App\Jobs;

use App\Mail\SentWithdrawRequestApprovedEmail;
use App\Models\WithdrawRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentWithdrawRequestApprovedEmailToCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $withdraw = WithdrawRequest::with('user')->where('id', $this->withdraw->id)->first();
        logger($withdraw);
        if ($withdraw->user->email != null) {
            Mail::to($withdraw->user)->queue(new SentWithdrawRequestApprovedEmail($withdraw));
        }
    }
}
