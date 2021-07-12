<?php

namespace App\Repositories;

use App\Models\Course;
use App\Notifications\CourseApproved;
use Illuminate\Support\Facades\Notification;

class ApproveCourseRepository
{
    public static function store(Course $course)
    {
        if ($course->approved != 1) {
            $course->approved = 1;
            $course->save();
            Notification::send($course->instructor->user, new CourseApproved($course));
        } else {
            $course->approved = 0;
            $course->save();
        }
        return $course->approved;
    }
}
