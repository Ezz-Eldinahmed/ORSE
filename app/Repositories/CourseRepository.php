<?php

namespace App\Repositories;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseRepository
{
    public function index()
    {
        return Course::where('approved', 1)
            ->with('lessons')
            ->withCount('seens')
            ->orderBy('id', 'desc')->paginate(10);
    }

    public function all()
    {
        return Course::latest()->paginate(10);
    }

    public function store(CourseRequest $request)
    {
        return Course::create($request->all());
    }

    public function update(CourseRequest $request, Course $course)
    {
        return $course->update($request->validated());
    }

    public function destroy(Course $course)
    {
        return $course->delete();
    }

    public function show(Course $course)
    {
        if (Auth::check()) {
            $course->seens()->firstOrCreate([
                'user_id' => auth()->user()->id,
            ]);
        }

        return $course;
    }
}
