<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LenderNotification extends Notification
{
    use Queueable;
    private $gameNames;

    /**
     * LenderNotification constructor.
     * @param $gameNames
     */
    public function __construct($gameNames)
    {
        $this->gameNames = $gameNames;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Gamehub Lend Confirmation')
            ->line('You Lend the game(s): ' .implode(", ", $this->gameNames). ' successfully')
            ->line('Thank you for being with us');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
