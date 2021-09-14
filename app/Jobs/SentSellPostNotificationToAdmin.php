<?php

namespace App\Jobs;

use App\Mail\NewSellPostAvailableMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SentSellPostNotificationToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $product;
    public $admin;

    /**
     * SentSellPostNotificationToAdmin constructor.
     * @param $product
     * @param $admin
     */
    public function __construct($product, $admin)
    {
        $this->product = $product;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin)->queue(new NewSellPostAvailableMail($this->product));
    }
}
