<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Question;
use App\Models\Rate;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $questions = cache()->remember('questions-welcome', 60 * 60 * 12, function () {
            return Question::count();
        });

        $approvedCourses = cache()->remember('approvedCourses-welcome', 60 * 60 * 12, function () {
            return Course::where('approved', 1)->count();
        });

        $rates = cache()->remember('rates-welcome', 60 * 60 * 12, function () {
            return Rate::count();
        });

        $categories_count = cache()->remember('categories-count-welcome', 60 * 60 * 12, function () {
            return Category::count();
        });

        $categories = cache()->remember('categories-welcome', 60 * 60 * 12, function () {
            return Category::take(9)->get();
        });

        $courses = cache()->remember('courses-welcome', 60 * 60 * 12, function () {
            return Course::where('approved', '1')
                ->withCount(['rates', 'users', 'seens'])
                ->with(['instructor'])
                ->take(3)->get();
        });

        return view(
            'welcome',
            [
                'categories' => $categories,
                'course_approved' => $approvedCourses,
                'rates' => $rates,
                'questions' => $questions,
                'courses' => $courses,
                'categories_count' => $categories_count
            ]
        );
    }

    public function profile(User $user)
    {
        return view('profile.profile', ['user' => $user]);
    }

    public function people()
    {
        return view('people');
    }
}
