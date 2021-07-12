<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use App\Models\Comment as CommentModel;
use App\Models\Course;
use App\Notifications\commentCourseForInstructor;
use Illuminate\Support\Facades\Notification;

class Comment extends Component
{
    public function render()
    {
        return view('livewire.course.comment', [
            'comments' => $this->course->comment()->latest()->get()

        ]);
    }

    public $comment = '';
    public $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function delete(CommentModel $comment)
    {
        $comment->delete();
        session()->flash('success', 'Comment Deleted Successfully');
    }

    public function create()
    {
        $data = $this->validate([
            'comment' => 'required|max:200'
        ]);

        $comment = $this->course->comment()->create([
            'comment' =>  $data['comment'],
            'user_id' => auth()->user()->id
        ]);

        Notification::send(
            $this->course->instructor->user,
            new commentCourseForInstructor(
                $comment,
                $this->course,
                auth()->user(),
            )
        );

        $this->comment = '';
        session()->flash('success', 'Comment Added Successfully');
    }
}
