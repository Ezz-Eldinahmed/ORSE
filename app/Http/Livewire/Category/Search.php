<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.category.search', [
            'categories' => Category::SearchNameLikeOrDescription($this->search)
                ->latest()
                ->paginate(12)
        ]);
    }
}
