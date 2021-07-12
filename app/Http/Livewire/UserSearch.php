<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserSearch extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.user-search', [
            'users' => User::SearchNameLikeOrEmail($this->search)
                ->paginate(10)
        ]);
    }

    public function block(User $user)
    {
        if ($user->blocked_at == null) {
            $user->blocked_at = now();
            $user->save();
            session()->flash('message', 'User Blocked');
        } else {
            $user->blocked_at = null;
            $user->save();
            session()->flash('message', 'User UnBlocked');
        }
    }
}
