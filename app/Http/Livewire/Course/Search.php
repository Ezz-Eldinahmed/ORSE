<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $search = '';
    public $course_filter;
    private $courses;

    public function render()
    {
        if ($this->course_filter == null || $this->course_filter == 'all') {
            $this->courses = Course::learnSearch($this->search)
                ->latest()
                ->paginate(12);
        } else if ($this->course_filter == 'premium') {
            $this->courses = Course::where('price', '!=', 0)
                ->learnSearch($this->search)
                ->latest()
                ->paginate(12);
        } else if ($this->course_filter == 'free') {
            $this->courses = Course::where('price', '==', 0)
                ->learnSearch($this->search)
                ->latest()
                ->paginate(12);
        }

        return view('livewire.course.search', [
            'courses' => $this->courses
        ]);
    }
}
