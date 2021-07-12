<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $Category
     * @return mixed
     */
    public function AddCourse(User $user, Category $category)
    {
        if ($user->Instructor != null) {
            return $user->instructor->isInstructor($category->id);
        }
        return false;
    }
}
