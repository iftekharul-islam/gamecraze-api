<?php

namespace App\Jobs;

use App\Mail\SendPasswordResetCodeMail;
use App\Models\PasswordReset;
use App\Notifications\PasswordResetRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

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

        PasswordReset::create([
            'email' => $this->user->email,
            'otp' => $this->otp
        ]);

        Mail::to($this->user->email)
            ->queue(new SendPasswordResetCodeMail($this->otp));

    }
}
