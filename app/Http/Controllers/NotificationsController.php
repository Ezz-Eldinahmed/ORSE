<?php

namespace App\Http\Controllers;

class NotificationsController extends Controller
{
    public function show()
    {
        $notification = auth()->user()->unreadNotifications;
        $notification->markAsRead();

        return view('notification', [
            'notifications' => auth()->user()->notifications()->latest()->paginate(10)
        ]);
    }
}
