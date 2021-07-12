<?php

namespace App\Repositories;

use App\Http\Requests\LessonRequest;
use App\Http\Resources\ApiResource;
use App\Models\Course;
use App\Models\Lesson;
use App\Notifications\LessonAdded;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LessonRepository
{
    public function store(LessonRequest $request)
    {
        $course = Course::findOrFail($request->course_id);

        $lesson =  Lesson::create([
            'name' =>  $request->name,
            'description' => $request->description,
            'course_id' => $request->course_id
        ]);

        foreach ($course->users()->get() as $key => $user) {
            Notification::send($user, new LessonAdded($course));
        }
        return new ApiResource($lesson);
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        return $lesson->update($request->validated());
    }

    public function destroy(Lesson $lesson)
    {
        return $lesson->delete();
    }

    public function show(Lesson $lesson)
    {
        if (Auth::check()) {
            $lesson->seens()->firstOrCreate([
                'user_id' => auth()->user()->id,
            ]);
        }
        return $lesson;
    }
}
