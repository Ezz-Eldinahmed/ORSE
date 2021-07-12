<?php

namespace App\Http\Livewire\Social;

use Livewire\Component;
use App\Models\User;
use App\Notifications\FollowHappens;
use Illuminate\Support\Facades\Notification;

class Follow extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function follow(User $user)
    {
        if (auth()->user()->following($user)) {
            auth()->user()->unfollow($user);
        } else {
            if (auth()->user()->id != $user->id) {
                auth()->user()->follow($user);
                Notification::send(
                    $this->user,
                    new FollowHappens(
                        auth()->user(),
                    )
                );
            }
        }
    }
    public function render()
    {
        return view('livewire.social.follow');
    }
}
