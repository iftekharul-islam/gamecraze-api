<?php

namespace App\Jobs;

use App\Mail\CreatedOrderMail;
use App\Mail\SendLenderNotificationMail;
use App\Mail\SendRenterNotificationMail;
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
use Illuminate\Support\Facades\Mail;

class SendEmailToRenter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $renterDetails;
    private $gameNames;
    private $orderNo;

    /**
     * SendEmailToRenter constructor.
     * @param $renterDetails
     * @param $gameNames
     */
    public function __construct($renterDetails, $gameNames, $orderNo)
    {
        $this->renterDetails = $renterDetails;
        $this->gameNames = $gameNames;
        $this->orderNo = $orderNo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lender = auth()->user();
        if ($lender->email != null) {
            Mail::to($lender->email)->queue(new SendLenderNotificationMail($this->gameNames, $this->orderNo));
        }
        foreach($this->renterDetails as $item) {
            $user = User::where('id', $item['renter_id'])->first();
            if ($user->email != null) {
                Mail::to($user->email)->queue(new SendRenterNotificationMail($item['game_name']));
            }
        }
        $admins = config('admin_mail.mail_to');
        foreach ($admins as $admin){
            Mail::to($admin)->queue(new CreatedOrderMail($lender, $this->orderNo, $this->gameNames));
        }

    }
}
