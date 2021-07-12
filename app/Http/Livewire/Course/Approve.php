<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\ApproveCourseRepository;

class Approve extends Component
{
    use WithPagination;

    public $search = '';
    public $course_filter;
    public $direction = 'asc';
    private $courses;

    public function sortDesc()
    {
        $this->direction = 'desc';
    }

    public function sortAsc()
    {
        $this->direction = 'asc';
    }

    public function render()
    {
        if ($this->course_filter == null || $this->course_filter == 'all') {
            $this->courses = Course::approveSearch($this->search, $this->direction, ['instructor']);
        } else if ($this->course_filter == 'pending') {
            $this->courses = Course::approved(0)
                ->approveSearch($this->search, $this->direction, ['instructor']);
        } else if ($this->course_filter == 'ِapproved') {
            $this->courses = Course::approved(1)
                ->approveSearch($this->search, $this->direction, ['instructor']);
        }
        return view(
            'livewire.course.approve',
            [
                'courses' => $this->courses
            ]
        );
    }

    public function approve(Course $course)
    {
        return ApproveCourseRepository::store($course) ?

            session()->flash('success', 'Course Approved Successfully')
            :
            session()->flash('message', 'Course Added To Pending');
    }
}
