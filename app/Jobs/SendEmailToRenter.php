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
    private $renterDetails;
    private $gameNames;

    /**
     * SendEmailToRenter constructor.
     * @param $renterDetails
     * @param $gameNames
     */
    public function __construct($renterDetails, $gameNames)
    {
        $this->renterDetails = $renterDetails;
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
        $lender->notify(new LenderNotification($this->gameNames));
        foreach($this->renterDetails as $item) {
            $user = User::where('id', $item['renter_id'])->first();
            $user->notify(new RenterNotification($item['game_name']));
        }

    }
}
