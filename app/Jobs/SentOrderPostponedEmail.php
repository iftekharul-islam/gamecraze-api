<?php

namespace App\Jobs;

use App\Mail\RentOrderPostponedMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentOrderPostponedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $order;

    /**
     * SentOrderProcessingEmail constructor.
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lender = User::find($this->order->user_id);
        if ($lender->email != null){
            Mail::to($lender->email)->queue(new RentOrderPostponedMail($this->order, $lender->name));
        }
    }
}
