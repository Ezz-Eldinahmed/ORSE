<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class HomePageSearch extends Component
{
    public $search_navbar = '';

    public function render()
    {
        return view('livewire.home-page-search', [
            'courses' => Course::approved(1)
                ->searchNameLikeOrDescription($this->search_navbar)
                ->take(3)
                ->get(),
            'categories' => Category::SearchNameLikeOrDescription($this->search_navbar)
                ->take(3)
                ->get(),
            'users' => User::SearchNameLikeOrEmail($this->search_navbar)
                ->where('id', '!=', (auth()->id()))
                ->whereNull('blocked_at')
                ->take(3)
                ->get()
        ]);
    }
}
