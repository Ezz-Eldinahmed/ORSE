<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class commentVideoForInstructor extends Notification
{
    use Queueable;

    public $comment;
    public $user;
    public $video;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment, $video, $user)
    {
        $this->comment = $comment;
        $this->video = $video;
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
            'comment' => $this->comment,
            'video' => $this->video,
            'user' => $this->user,
        ];
    }
}
