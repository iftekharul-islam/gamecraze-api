<?php

namespace App\Jobs;

use App\Mail\SentWithdrawRequestEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentWithdrawRequestToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $withdraw;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($withdraw)
    {
        $this->withdraw = $withdraw;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admins = config('admin_mail.mail_to');
        foreach ($admins as $admin) {
            Mail::to($admin)->queue(new SentWithdrawRequestEmail($this->withdraw));
        }
    }
}
