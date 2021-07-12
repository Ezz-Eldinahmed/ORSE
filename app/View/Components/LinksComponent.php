<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinksComponent extends Component
{
    public $paginator;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.links-component');
    }
}
