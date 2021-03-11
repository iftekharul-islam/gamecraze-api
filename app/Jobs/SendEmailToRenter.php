<?php

namespace App\Jobs;

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
    private $data;
    private $rentIds;

    /**
     * SendEmailToRenter constructor.
     * @param $renterIds
     * @param $data
     * @param $rentIds
     */
    public function __construct($renterIds, $data, $rentIds)
    {
        $this->renterIds = $renterIds;
        $this->data = $data;
        $this->rentIds = $rentIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lender = auth()->user();
        Lender::insert($this->data);
        Rent::whereIn('id', $this->rentIds)->update(['rented_user_id' => $lender->id]);
        $users = User::whereIn('id', $this->renterIds)->get();

        $lender->notify(new LenderNotification());
        foreach($users as $user) {
            $user->notify(new RenterNotification());
        }

    }
}
