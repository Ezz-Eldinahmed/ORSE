<?php

namespace App\Http\Livewire\Question;

use Livewire\Component;
use App\Models\Category;
use App\Models\Question;

class Update extends Component
{
    public $question;
    public $question_edit;
    public $category_id;

    public function render()
    {
        return view('livewire.question.update', [
            'categories' => Category::all(['id', 'name']),

        ]);
    }

    public function editQuestion()
    {
        $data = $this->validate([
            'question_edit' => 'required|max:1000',
            'category_id' => 'required|exists:categories,id'
        ]);

        $this->question->update([
            'question' => $this->question_edit,
            'category_id' => $this->category_id
        ]);

        session()->flash('message', 'Question Updated Successfully');
    }

    public function mount(Question $question)
    {
        $this->$question = $question;
        $this->question_edit = $question->question;
        $this->category_id = $question->category_id;
    }

    public function delete()
    {
        $this->question->delete();
        redirect()->route('question.index');
    }
}
