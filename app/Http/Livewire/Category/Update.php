<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Update extends Component
{
    public $category;
    public $name;
    public $description;

    public function render()
    {
        return view('livewire.category.update');
    }

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function edit()
    {
        $data = $this->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:300',
        ]);

        $this->category->update($data);

        session()->flash('success', 'Category Updated Successfully');
    }

    public function delete()
    {
        $this->category->delete();
        redirect()->route('home');
    }
}
