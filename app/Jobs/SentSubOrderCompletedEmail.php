<?php

namespace App\Jobs;

use App\Mail\RentSubOrderCompletedMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentSubOrderCompletedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $lend;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($lend)
    {
        $this->lend = $lend;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lender = User::find($this->lend->lender_id);
        if ($lender->email != null){
            Mail::to($lender->email)->queue(new RentSubOrderCompletedMail($this->lend));
        }
    }
}
