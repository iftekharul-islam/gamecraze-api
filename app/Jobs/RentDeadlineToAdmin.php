<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\RentDeadlineAdminNotification;
use App\Notifications\RentDeadlineNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RentDeadlineToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user;
    private $admin;
    private $endDate;

    /**
     * RentDeadlineToAdmin constructor.
     * @param User $admin
     * @param $user
     * @param $endDate
     */
    public function __construct($user, $admin, $endDate)
    {
        $this->admin = $admin;
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
        $this->admin->notify(new RentDeadlineAdminNotification($this->user, $this->endDate));
    }
}
