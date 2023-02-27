<?php

namespace App\Jobs;

use App\Mail\RenterPostRejectMail;
use App\Models\Game;
use App\Models\User;
use App\Notifications\RenterPostEjectNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RejectEmailToRenter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $renter;
    private $rent;

    /**
     * RejectEmailToRenter constructor.
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
        if ($this->renter->email != null){
            Mail::to($this->renter->email)->queue(new RenterPostRejectMail($this->renter->name, $this->rent));
        }
    }
}
