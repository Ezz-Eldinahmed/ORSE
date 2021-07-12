<?php

namespace App\Http\Livewire\Question;

use Livewire\Component;
use App\Models\Category;
use App\Models\Question;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $question;
    public $category_id;
    public $category_filter;
    public $images = [];

    public function render()
    {
        if ($this->category_filter != null) {
            $this->questions = Question::where('category_id', $this->category_filter)
                ->questionFilter($this->search, ['user', 'category', 'image'])
                ->latest()
                ->paginate(10);
        } else {
            $this->questions = Question::questionFilter($this->search, ['user', 'category', 'image'])
                ->latest()
                ->paginate(10);
        }

        return view('livewire.question.create', [
            'categories' => Category::all(['id', 'name']),
            'questions' => $this->questions

        ]);
    }

    public function createQuestion()
    {
        $data = $this->validate([
            'question' => 'required|max:1000',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'required|image|max:5000'
        ]);

        $question = Question::create($data);

        if (isset($this->images)) {
            foreach ($this->images as $key => $value) {
                $image = $value->store('/', 'image');
                $question->image()->create([
                    'image' =>  $image,
                    'user_id' => auth()->user()->id
                ]);
            }
        }
        $this->images = [];
        $this->question = '';
        session()->flash('message', 'Question Added Successfully');
    }

    public function delete(Question $question)
    {
        $question->delete();
        session()->flash('message', 'Question Deleted!');
    }
}
