<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\ApiResource;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Video;
use App\Notifications\commentCourseForInstructor;
use App\Notifications\commentLessonForInstructor;
use App\Notifications\commentVideoForInstructor;
use Illuminate\Support\Facades\Notification;

class CommentController
{
    public function destroy(Comment $comment): ?bool
    {
        return $comment->delete();
    }

    public function course(CommentRequest $request, Course $course): ApiResource
    {
        $comment = $course->comment()->create([
            'comment' =>  $request->comment,
            'user_id' => auth()->user()->id
        ]);

        Notification::send(
            $course->instructor->user,
            new commentCourseForInstructor(
                $comment,
                $course,
                auth()->user(),
            )
        );
        return new ApiResource($comment);
    }

    public function lesson(CommentRequest $request, Lesson $lesson): ApiResource
    {
        $comment = $lesson->comment()->create([
            'comment' =>  $request->comment,
            'user_id' => auth()->user()->id
        ]);

        Notification::send(
            $lesson->instructor->user,
            new commentLessonForInstructor(
                $comment,
                $lesson,
                auth()->user(),
            )
        );

        return new ApiResource($comment);
    }
    public function video(CommentRequest $request, Video $video): ApiResource
    {
        $comment = $video->comment()->create([
            'comment' =>  $request->comment,
            'user_id' => auth()->user()->id
        ]);

        Notification::send(
            $video->instructor->user,
            new commentVideoForInstructor(
                $comment,
                $video,
                auth()->user(),
            )
        );

        return new ApiResource($comment);
    }
}
