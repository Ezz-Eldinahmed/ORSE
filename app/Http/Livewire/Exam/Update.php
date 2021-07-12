<?php

namespace App\Http\Livewire\Exam;

use Livewire\Component;
use App\Models\Exam;
use App\Models\ExamQuestion;

class Update extends Component
{
    public $exam;
    public $question;
    public $a;
    public $b;
    public $c;
    public $d;
    public $correct;
    public $difficulty = 1;
    public $level;

    public function render()
    {
        return view('livewire.exam.update', ['exam' => $this->exam->refresh()]);
    }

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
        $this->level = $exam->level;
    }

    public function createExamQuestion()
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

        $data['course_id'] = $this->exam->course->id;
        $data['exam_id'] = $this->exam->id;

        ExamQuestion::create($data);

        $this->difficulty = '';
        $this->a = '';
        $this->b = '';
        $this->c = '';
        $this->d = '';
        $this->correct = '';
        $this->question = '';

        session()->flash('message', 'Question Created Successfully');
    }

    public function examUpdate()
    {
        $data = $this->validate([
            'level' => 'required|unique:exams,course_id|in:1,2,3'
        ]);

        $this->exam->update($data);
        session()->flash('message', 'Exam Updated Successfully');
    }

    public function delete()
    {
        $this->exam->delete();
        redirect()->route('course.show', $this->exam->course);
    }

    public function examView(Exam $exam)
    {
        if ($exam->view == 0) {
            $exam->view = 1;
            $exam->save();
        } else {
            $exam->view = 0;
            $exam->save();
        }
    }
}
