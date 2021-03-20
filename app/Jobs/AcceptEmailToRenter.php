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
        $this->renter->notify(new RenterPostAcceptNotification($this->game));
    }
}
