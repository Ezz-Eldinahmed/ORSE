<?php

namespace App\Http\Livewire\Lesson;

use Livewire\Component;
use App\Models\Lesson;

class Update extends Component
{
    public $lesson;
    public $name;
    public $description;

    public function render()
    {
        return view('livewire.lesson.update', ['lesson' => $this->lesson->refresh()]);
    }

    public function delete(Lesson $lesson)
    {
        $lesson->delete();
        redirect()->route('course.show', $lesson->course);
    }

    public function edit(Lesson $lesson)
    {
        $data = $this->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
        ]);

        $lesson->update($data);

        session()->flash('message', 'Lesson Updated Successfully');
    }

    public function mount(Lesson $lesson)
    {
        $this->description = $lesson->description;
        $this->name = $lesson->name;
        $this->lesson = $lesson;
    }
}
