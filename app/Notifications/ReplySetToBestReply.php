<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReplySetToBestReply extends Notification
{
    use Queueable;

    public $reply;

    public $question;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($question)
    {
        $this->question = $question;
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
            'question' => $this->question
        ];
    }
}
