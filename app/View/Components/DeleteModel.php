<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteModel extends Component
{
    public $message;
    public $deleted;
    public $method;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $deleted = null, $method = 'delete')
    {
        $this->deleted = $deleted;
        $this->message = $message;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete-model');
    }
}
