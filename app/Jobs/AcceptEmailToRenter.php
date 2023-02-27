<?php

namespace App\Jobs;

use App\Mail\RenterPostAcceptMail;
use App\Models\User;
use App\Notifications\RenterPostAcceptNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AcceptEmailToRenter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $renter;
    private $game;

    /**
     * AcceptEmailToRenter constructor.
     * @param User $renter
     * @param Game $game
     */
    public function __construct(User $renter, $game)
    {
        $this->renter = $renter;
        $this->game = $game;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->renter->email != null){
            Mail::to($this->renter->email)->queue(new RenterPostAcceptMail($this->renter->name, $this->game));
        }
    }
}
