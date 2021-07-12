<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public $message;

    public $header;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $header)
    {
        $this->message = $message;
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.header-component');
    }
}
