<?php

namespace App\Notifications;

use App\Models\Assign;
use App\Models\TaskItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignNotification extends Notification
{
    use Queueable;

    private $assign;

    /**
     * Create a new notification instance.
     */
    public function __construct(Assign $assign)
    {
        $this->assign = $assign;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('You are assigned to task item ' . $this->assign->taskitems->title . '!')
                    ->action('Visit this url to finish your work', url('/'))
                    ->line('Thank you for your hard work!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
