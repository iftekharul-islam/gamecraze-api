<?php

namespace App\Jobs;

use App\Notifications\RenterNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToRenter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $rent;

    /**
     * Create a new job instance.
     *
     * @param $renter
     */
    public function __construct($rent)
    {
        $this->rent = $rent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->renter->notify(new RenterNotification());
    }
}
