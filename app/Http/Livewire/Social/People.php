<?php

namespace App\Http\Livewire\Social;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class People extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        return view('livewire.social.people', [
            'peoples' => User::SearchNameLikeOrEmail($this->search)
                ->where('id', '!=', (auth()->id()))
                ->whereNull('blocked_at')
                ->paginate(12)
        ]);
    }
}
