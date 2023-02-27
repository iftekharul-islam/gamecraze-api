<?php

namespace App\Jobs;

use App\Mail\SendExtendLendConfirmMail;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentExtendEmailToCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $lender;
    public $rent_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($lender, $rent_id)
    {
        $this->lender = $lender;
        $this->rent_id = $rent_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::findOrFail($this->lender);
        $rent = Rent::with('game')->where('id', $this->rent_id)->first();
        if ($user->email != null) {
            Mail::to($user)->queue(new SendExtendLendConfirmMail($user->name, $rent->game->name));
        }
    }
}
