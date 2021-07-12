<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public function render()
    {
        return view('livewire.notification', [
            'notifications' => auth()->user()->unreadNotifications
        ]);
    }

    public function show()
    {
        $notification = auth()->user()->unreadNotifications;
        $notification->markAsRead();
    }
}
