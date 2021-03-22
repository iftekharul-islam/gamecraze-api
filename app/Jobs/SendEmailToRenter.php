<?php

namespace App\Jobs;

use App\Models\Game;
use App\Models\Lender;
use App\Models\Rent;
use App\Models\User;
use App\Notifications\LenderNotification;
use App\Notifications\RenterNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToRenter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $renterIds;
    private $gameNames;

    /**
     * SendEmailToRenter constructor.
     * @param $renterIds
     * @param $gameNames
     */
    public function __construct($renterIds, $gameNames)
    {
        $this->renterIds = $renterIds;
        $this->gameNames = $gameNames;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lender = auth()->user();
        $users = User::whereIn('id', $this->renterIds)->get();

        $lender->notify(new LenderNotification($this->gameNames));
        foreach($users as $user) {
            $user->notify(new RenterNotification());
        }

    }
}
