<?php

namespace App\Jobs;

use App\Mail\SentNoticeEmailToCustomer;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentNoticeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $notice;

    /**
     * SentNoticeEmail constructor.
     * @param Notice $notice
     */
    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })->get();

        logger('total user');
        logger(count($users));

        foreach ($users as $user) {
            if ($user->email != null){
                logger('user email id');
                logger($user->email);
                Mail::to($user)->queue(new SentNoticeEmailToCustomer($this->notice, $user->name));
            }
        }
    }
}
