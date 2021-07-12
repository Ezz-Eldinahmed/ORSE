<?php

namespace App\Http\Controllers\web\Mange;

use App\Models\Category;
use App\Models\Certification;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Instructor;
use App\Models\Interviewer;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Question;
use App\Models\Rate;
use App\Models\Reply;
use App\Models\Seen;
use App\Models\User;
use App\Models\Video;

class AdminController
{
    public int $joins = 0;

    public function dashboard()
    {
        foreach (Course::with('users')->get() as $key => $course) {
            $this->joins += $course->users->count();
        }

        return view(
            'admin.dashboard',
            [
                'joins' => $this->joins,
                'users' => User::count(),
                'courses' => Course::count(),
                'questions' => Question::count(),
                'categories' => Category::count(),
                'comments' => Comment::count(),
                'certificates' => Certification::count(),
                'contact' => Contact::count(),
                'exam' => Exam::count(),
                'instructor' => Instructor::count(),
                'interviewer' => Interviewer::count(),
                'lesson' => Lesson::count(),
                'rate' => Rate::count(),
                'replies' => Reply::count(),
                'videos' => Video::count(),
                'seens' => Seen::count(),
                'payments' => Payment::count(),
                'gain' => Payment::sum('amount')
            ]
        );
    }

    public function index()
    {
        return view('admin.index');
    }

    public function show(User $user)
    {
        return view('admin.show', ['user' => $user, 'categories' => Category::all(['id', 'name'])]);
    }
}
