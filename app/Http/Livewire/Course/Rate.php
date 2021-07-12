<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class Rate extends Component
{
    public $rate = 0;
    public $course;
    public $showRate;
    public $price;
    public $presentation = 'Slides';
    public $assignments;
    public $description;
    public $speed = 'Slow';
    public $name;

    public function mount(Course $course)
    {
        $this->price = $course->price;
        $this->presentation = $course->presentation;
        $this->assignments = $course->assignments;
        $this->description = $course->description;
        $this->speed = $course->speed;
        $this->name = $course->name;
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.course.rate', ['course' => $this->course->refresh()]);
    }

    public function rate($rate)
    {
        $this->course->rates()->create([
            'rate' =>  $rate,
            'user_id' => auth()->user()->id
        ]);

        $this->course->instructor->rates()->create([
            'rate' =>  $rate,
            'user_id' => auth()->user()->id
        ]);
    }

    public function delete()
    {
        $this->course->delete();
        redirect()->route('category.show', $this->course->category);
    }

    public function edit()
    {
        $data = $this->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:300',
            'presentation' => 'required|in:Slides,FreeHand,Talking',
            'speed' => 'required|in:Slow,Normal,Fast',
            'price' => 'required|integer|max:1000',
            'assignments' => 'required'
        ]);

        $this->course->update($data);

        session()->flash('message', 'Course Updated Successfully');
    }
}
