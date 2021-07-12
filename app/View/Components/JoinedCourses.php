<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JoinedCourses extends Component
{
    public $joined;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->joined = auth()->user()->courses()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.joined-courses');
    }
}
