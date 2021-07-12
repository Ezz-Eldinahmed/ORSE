<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InstructorCourses extends Component
{
    public $mades;
    public $categoriesApproved;
    public $categoriesRequested;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoriesApproved = auth()->user()->instructor->categories()->where('approved', 1)->get();
        $this->categoriesRequested = auth()->user()->instructor->categories()->where('approved', 0)->get();
        $this->mades = auth()->user()->instructor->courses()->where('approved', 1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.instructor-courses');
    }
}
