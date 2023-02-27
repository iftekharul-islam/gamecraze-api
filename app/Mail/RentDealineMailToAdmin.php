<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentDealineMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $lend;
    public $deadline;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lend, $deadline)
    {
        $this->lend = $lend;
        $this->deadline = $deadline;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('new_email.rent_deadline_notification_to_admin')
            ->subject('Rent Complete Reminder')
            ->with([
                'lend' => $this->lend,
                'end_date' => $this->deadline
            ]);
    }
}
