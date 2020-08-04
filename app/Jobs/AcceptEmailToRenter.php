<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\RenterPostAcceptNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AcceptEmailToRenter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $renter;
    private $rent;

    /**
     * AcceptEmailToRenter constructor.
     * @param User $renter
     * @param $rent
     */
    public function __construct(User $renter, $rent)
    {
        $this->renter = $renter;
        $this->rent = $rent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->renter->notify(new RenterPostAcceptNotification($this->rent));
    }
}
