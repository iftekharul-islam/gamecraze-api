<?php

namespace App\Jobs;

use App\Mail\SendPasswordResetMail;
use App\Models\ResetPasswordToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendResetPasswordLinkToEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger('send: ' . json_encode($this->user));
        // logger('user: '.$this->user->id . ' email: '. $this->user->email);
        $token = hash('sha256', Str::random(30));
        $link = env('GAMEHUB_FRONT') . '/update-password/' . $token;
        $expires = Carbon::now()->addHours(1)->format('Y-m-d H:i:s');

        $create = ResetPasswordToken::create([
            'user_id' => $this->user->id,
            'token' => $this->user->id,
            'expires_at' => $expires
        ]);

        Mail::to($this->user->email)
            ->queue(new SendPasswordResetMail($this->user->name, $link));
    }
}
