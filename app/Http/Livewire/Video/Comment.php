<?php

namespace App\Http\Livewire\Video;

use App\Models\Comment as CommentModel;
use App\Models\Video;
use App\Notifications\commentVideoForInstructor;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Comment extends Component
{

    public $comment = '';
    public $video;

    public function mount(Video $video)
    {
        $this->$video = $video;
    }

    public function delete(CommentModel $comment)
    {
        $comment->delete();
        session()->flash('message', 'Comment Deleted Successfully');
    }

    public function create()
    {
        $data = $this->validate([
            'comment' => 'required|max:200'
        ]);

        $comment = $this->video->comment()->create([
            'comment' =>  $data['comment'],
            'user_id' => auth()->user()->id
        ]);

        Notification::send(
            $this->video->lesson->course->instructor->user,
            new commentVideoForInstructor(
                $comment,
                $this->video,
                auth()->user()
            )
        );

        $this->comment = '';
        session()->flash('message', 'Comment Created Successfully');
    }

    public function render()
    {
        return view(
            'livewire.video.comment',
            [
                'comments' => $this->video->comment()->latest()->get()
            ]
        );
    }
}
