<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamPolicy
{
    use HandlesAuthorization;

    public function ownerExam(User $user, Exam $exam)
    {
        $instructor = $user->instructor->categories()->where('categories.id', $exam->course->category->id)->first();
        if ($instructor) {
            return $instructor->pivot->approved;
        }
    }

    public function viewExam(User $user, Exam $exam)
    {
        return $exam->view == 1;
    }
}
