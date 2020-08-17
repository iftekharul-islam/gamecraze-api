<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentDeadlineAdminNotification extends Notification
{
    use Queueable;
    private $user;
    private $endDate;

    /**
     * RentDeadlineAdminNotification constructor.
     * @param User $user
     * @param $endDate
     */
    public function __construct(User $user, $endDate)
    {
        $this->user = $user;
        $this->endDate = $endDate;
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
                        ->line('Customer name: ' . $this->user->name . ' & deadline date is '. $this->endDate->format('d/m/Y') )
                        ->line('Its already 2 days left')
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
