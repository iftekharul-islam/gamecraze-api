<?php

namespace App\Jobs;

use App\Mail\SendExtendLendConfirmMail;
use App\Mail\SendExtendLendRequestMail;
use App\Models\Lender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentExtendEmailToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $lend;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Lender $lend)
    {
        $this->lend = $lend;
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
            Mail::to($admin)->queue(new SendExtendLendRequestMail($this->lend));
        }
    }
}
