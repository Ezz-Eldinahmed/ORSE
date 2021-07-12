<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-admin', function (User $user) {
            if ($user->role != null) {
                return $user->role->role == 1;
            }
        });

        Gate::define('view-interviewer', function (User $user) {
            if ($user->interviewer != null) {
                return $user->interviewer->approved;
            }
            if ($user->role != null) {
                return $user->role->role == 1;
            }
        });

        Gate::define('view-instructor', function (User $user, Category $category) {
            if ($user->instructor()->isInstructor($category->id)) {
                return $user->instructor()->categories()->where('categories.id', $category->id)->first()->pivot->approved;
            }
        });

        Gate::define('comment', function (User $user, Comment $comment) {
            return $comment->user_id == $user->id;
        });

        Passport::routes();
    }
}
