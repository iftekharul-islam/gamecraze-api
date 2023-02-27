<?php

namespace App\Jobs;

use App\Mail\RentDealineMailToAdmin;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RentDeadlineToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $lend;
    private $admin;
    private $endDate;

    /**
     * RentDeadlineToAdmin constructor.
     * @param User $admin
     * @param $user
     * @param $endDate
     */
    public function __construct($lend, $admin, $endDate)
    {
        $this->admin = $admin;
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
        logger('sent mail to lender '. $this->admin->email);
        Mail::to($this->admin)->queue(new RentDealineMailToAdmin($this->lend, $this->endDate));
    }
}
