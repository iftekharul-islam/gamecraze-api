<?php

namespace App\Jobs;

use App\Models\PasswordReset;
use App\Notifications\PasswordResetRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendResetCodeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $otp;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $otp
     */
    public function __construct($user, $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new PasswordResetRequest($this->otp));

        PasswordReset::create([
            'email' => $this->user->email,
            'otp' => $this->otp
        ]);
    }
}
