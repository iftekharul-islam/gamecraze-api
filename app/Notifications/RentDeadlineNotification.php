<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentDeadlineNotification extends Notification
{
    use Queueable;
    private $endDate;
    private $game;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($endDate, $game)
    {
        $this->endDate = $endDate;
        $this->game = $game;
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
                    ->line('Your Borrowed Game is '. $this->game->name )
                    ->line('Your deadline date is '. $this->endDate->format('d/m/Y') )
                    ->line('Its almost 2 days left & if you want play this game for more times.Please contact with helpline.')
                    ->line('Thank you for stay with us!');
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
