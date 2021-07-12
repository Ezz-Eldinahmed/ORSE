<?php

namespace App\Http\Livewire\Lesson;

use Livewire\Component;
use App\Models\Comment as CommentModel;
use App\Models\Lesson;
use App\Notifications\commentLessonForInstructor;
use Illuminate\Support\Facades\Notification;

class Comment extends Component
{
    public function render()
    {
        return view('livewire.lesson.comment', [
            'comments' => $this->lesson->comment()->latest()->get()

        ]);
    }

    public $comment = '';
    public $lesson;

    public function mount(Lesson $lesson)
    {
        $this->$lesson = $lesson;
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

        $comment = $this->lesson->comment()->create([
            'comment' =>  $data['comment'],
            'user_id' => auth()->user()->id
        ]);

        Notification::send(
            $this->lesson->course->instructor->user,
            new commentLessonForInstructor(
                $comment,
                $this->lesson,
                auth()->user()
            )
        );

        $this->comment = '';
        session()->flash('message', 'Comment Created Successfully');
    }
}
