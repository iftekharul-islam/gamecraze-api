<?php

namespace App\Mail;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SentNoticeEmailToCustomer extends Mailable
{
    use Queueable, SerializesModels;
    public $notice;
    public $name;

    /**
     * SentNoticeEmailToCustomer constructor.
     * @param Notice $notice
     * @param User $name
     */
    public function __construct(Notice $notice,$name)
    {
        $this->notice = $notice;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.new_notice_to_customer')
            ->subject($this->notice->title)
            ->with([
                'name' => $this->name,
                'notice' => $this->notice,
            ]);
    }
}
