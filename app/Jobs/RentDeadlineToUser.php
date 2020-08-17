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
    private $user;
    private $endDate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $endDate)
    {
        $this->user = $user;
        $this->endDate = $endDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new RentDeadlineNotification($this->endDate));
    }
}
