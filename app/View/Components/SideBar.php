<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SideBar extends Component
{
    public $instructors_sidebar;
    public $categories_sidebar;
    public $questions_sidebar;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instructors_sidebar = cache()->remember('instructors-sidebar', 60 * 60 * 24, function () {
            return \App\Models\Instructor::where('approved',1)->with(['user', 'courses'])->take(5)->get();
        });

        $this->questions_sidebar = cache()->remember('questions-sidebar', 60 * 60 * 24, function () {
            return \App\Models\Question::orderBy('id', 'desc')->with(['user', 'category'])->take(3)->get();
        });

        $this->categories_sidebar = cache()->remember('categories-sidebar', 60 * 60 * 24, function () {
            return  \App\Models\Category::orderBy('id', 'desc')->take(5)->get();
        });
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.side-bar');
    }
}
