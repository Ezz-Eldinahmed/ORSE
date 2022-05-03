<?php

namespace App\Http\Controllers\web\Learn;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\JoinCourseRepository;
use Illuminate\Http\RedirectResponse;

class JoinCourseController extends Controller
{
    public $joinCourseRepository;

    public function __construct(JoinCourseRepository $joinCourseRepository)
    {
        $this->joinCourseRepository = $joinCourseRepository;
    }

    public function join(Course $course)
    {
        return ($course->price > 0) ?
            $this->joinCourseRepository->payment($course) :
            $this->store($course);
    }

    public function store(Course $course): RedirectResponse
    {
        return ($this->joinCourseRepository->store($course) == true) ?
            redirect()->route('course.show', $course)
            ->with('success', 'You Have Already Joined') :

            redirect()->route('course.show', $course)
            ->with('success', 'Joined Successfully');
    }
}
