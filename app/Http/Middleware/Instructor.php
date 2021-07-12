<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Instructor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            $course = $request->route('course');
            $category = $request->route('category');
            $lesson = $request->route('lesson');
            $video = $request->route('video');
            $exam = $request->route('exam');
            $inst = Auth::user()->instructor;

            if ($inst != null) {
                if ($category != null) {
                    if ($inst->isInstructor($category->id)) {
                        return $next($request);
                    }
                } else if ($course != null) {
                    if ($inst->isInstructor($course->category->id)  && $inst->id == $course->instructor->id) {
                        return $next($request);
                    }
                } else if ($lesson != null) {
                    if ($inst->isInstructor($lesson->course->category->id) && $inst->id == $lesson->instructor->id) {
                        return $next($request);
                    }
                } else if ($video != null) {
                    if ($inst->isInstructor($video->lesson->course->category->id) && $inst->id == $video->instructor->id) {
                        return $next($request);
                    }
                } else if ($exam != null) {
                    if ($inst->isInstructor($exam->course->category->id) && $inst->id == $exam->course->instructor->id) {
                        return $next($request);
                    }
                }
                return redirect('/');
            }
            return redirect('/');
        }
    }
}
