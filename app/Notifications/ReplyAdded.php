<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyAdded extends Notification
{
    use Queueable;

    public $question;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($question, $user)
    {
        $this->question = $question;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'question' => $this->question,
            'user' => $this->user,
        ];
    }
}
