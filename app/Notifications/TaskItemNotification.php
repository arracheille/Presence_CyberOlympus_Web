<?php

namespace App\Notifications;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskItemNotification extends Notification
{
    use Queueable;

    private $schedules;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $schedules)
    {
        $this->schedules = $schedules;
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
        $message = (new MailMessage)
                    ->line('The following schedules are almost due!');
        foreach ($this->schedules as $schedule) {
            $message->line('- ' . $schedule->title . ' is almost due');
        }
        $message->action('Click this URL to continue', url('/'))
                ->line('Please finish these schedules immediately!');
        return $message;
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
