<?php

namespace App\Http\Livewire;

use App\Models\ExamQuestion;
use Livewire\Component;

class ExamQuestionEdit extends Component
{
    public $question;
    public $a;
    public $b;
    public $c;
    public $d;
    public $correct;
    public $difficulty;
    public $examQuestion;

    public function render()
    {
        return view('livewire.exam-question-edit');
    }

    public function mount(ExamQuestion $examQuestion)
    {
        $this->examQuestion = $examQuestion;
        $this->question = $examQuestion->question;
        $this->a = $examQuestion->a;
        $this->b = $examQuestion->b;
        $this->c = $examQuestion->c;
        $this->d = $examQuestion->d;
        $this->difficulty = $examQuestion->difficulty;
        $this->correct = $examQuestion->correct;
    }

    public function delete()
    {
        $this->examQuestion->delete();
        session()->flash('message', 'Exam Question Deleted Successfully');
    }

    public function updateExamQuestion()
    {
        $data = $this->validate([
            'question' => 'required|max:500',
            'difficulty' => 'required|in:1,2,3',
            'a' => 'required|max:300',
            'b' => 'required|max:300',
            'c' => 'required|max:300',
            'd' => 'required|max:300',
            'correct' => 'required|in:a,b,c,d'
        ]);

        $this->examQuestion->update($data);

        session()->flash('message', 'Question Updated Successfully');
    }
}
