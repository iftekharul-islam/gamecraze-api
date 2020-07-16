<?php

namespace App\Jobs;

use App\Notifications\LenderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToLender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $lender;

    /**
     * Create a new job instance.
     *
     * @param $lender
     */
    public function __construct($lender)
    {
        $this->lender = $lender;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->lender->notify(new LenderNotification());
    }
}
