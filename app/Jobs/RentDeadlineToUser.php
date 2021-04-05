<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\RentDeadlineNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RentDeadlineToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $lend;
    private $endDate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($lend, $endDate)
    {
        $this->lend = $lend;
        $this->endDate = $endDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger('sent mail to lender '. $this->lend->lender->email);
        $this->lend->lender->notify(new RentDeadlineNotification($this->endDate, $this->lend->rent->game));
    }
}
