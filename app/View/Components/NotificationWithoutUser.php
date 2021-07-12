<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotificationWithoutUser extends Component
{
    public $notification;
    public $message;
    public $route;
    public $redirect;
    public $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($notification, $message, $route, $redirect = '', $action = '')
    {
        $this->notification = $notification;
        $this->message = $message;
        $this->route = $route;
        $this->redirect = $redirect;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-without-user');
    }
}
