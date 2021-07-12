<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavBarComponent extends Component
{
    public $categories_navbar;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories_navbar = cache()->remember('categories-navbar', 60 * 60 * 12, function () {
            return \App\Models\Category::orderBy('id', 'desc')->take(5)->get();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.nav-bar-component');
    }
}
