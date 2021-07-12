<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return mixed
     */
    public function viewCourse(User $user, Course $course)
    {
        if ($user->instructor != null) {
            return $user->instructor->id == $course->instructor_id;
        }
    }

    public function joinCourse(User $user, Course $course)
    {
        return $user->courses()->where('course_id', $course->id)->first() == null;
    }

    public function rateCourse(User $user, Course $course)
    {
        return $user
            ->courses()
            ->where(
                'course_id',
                $course->id
            )->first() && ($course->approved == 1)
            && is_null($course->rated($course));
    }

    public function takeExam(User $user, Course $course)
    {
        if ($user->instructor != null) {
            $inst = $user->instructor->id;
        } else {
            $inst = 0;
        }
        return ($user
            ->courses()
            ->where(
                'course_id',
                $course->id
            )->first() && ($course->approved == 1)) || $inst == $course->instructor_id;
    }
}
