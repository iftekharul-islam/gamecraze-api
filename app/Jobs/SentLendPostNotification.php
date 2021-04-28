<?php

namespace App\Jobs;

use App\Mail\LendPostMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentLendPostNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $post;
    public $admin;

    /**
     * SentLendPostNotification constructor.
     * @param $post
     * @param $admin
     */
    public function __construct($post, $admin)
    {
        $this->post = $post;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin)->queue(new LendPostMail($this->post));
    }
}
