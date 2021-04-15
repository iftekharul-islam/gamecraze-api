<?php

namespace App\Mail;

use App\Models\Rent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LendPostMail extends Mailable
{
    use Queueable, SerializesModels;
    public $post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $post = Rent::with('user', 'game')->where('id', $this->post->id)->first();
        return $this->view('new_email.lend_post_notification_to_admin')
            ->subject('Rent Complete Reminder')
            ->with([
                'customer' => $post->user->name,
                'game' => $post->game->name
            ]);
    }
}