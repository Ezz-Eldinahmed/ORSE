<?php

namespace App\Http\Controllers\web\Learn;

use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\RedirectResponse;

class LessonWebController
{
    private $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function show(lesson $lesson)
    {
        return view('lesson.show', ['lesson' => $this->lessonRepository->show($lesson)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function store(LessonRequest $request, Course $course): RedirectResponse
    {
        $request['course_id'] = $course->id;

        $lesson = $this->lessonRepository->store($request);

        return redirect()->route('lesson.show', $lesson)
            ->with('success', 'Lesson Created Successfully');
    }
}
