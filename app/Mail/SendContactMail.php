<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        logger('data: ' . json_encode($this->data));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact')
            ->subject('New Contact Mail')
            ->with([
                'first_name' => $this->data['first_name'] ,
                'last_name' => $this->data['last_name'] ,
                'phone' =>  $this->data['phone'] ,
                'email' =>  $this->data['email'] ,
                'message' =>  $this->data['message'] ,
            ]);
    }
}
