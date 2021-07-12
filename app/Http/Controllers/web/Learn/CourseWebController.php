<?php

namespace App\Http\Controllers\web\Learn;

use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Repositories\CourseRepository;

class CourseWebController
{
    private $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        return view('course.index');
    }

    public function all()
    {
        return view('course.courseApprove');
    }

    public function store(CourseRequest $request, Category $category): \Illuminate\Http\RedirectResponse
    {
        $request['category_id'] = $category->id;
        $course = $this->courseRepository->store($request);
        return redirect()->route('course.show', $course)
            ->with('success', 'Course Added Successfully');
    }

    public function show(Course $course)
    {
        return view('course.show', ['course' => $this->courseRepository->show($course)]);
    }
}
