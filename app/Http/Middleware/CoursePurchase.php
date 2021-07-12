<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursePurchase
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
        $video = $request->route('video');
        $exam = $request->route('exam');

        if ($video != null) {
            $join = auth()->user()->courses()->where('course_id', $video->lesson->course->id)->first();
        } else {
            $join = auth()->user()->courses()->where('course_id', $exam->course->id)->first();
        }

        if (Auth::check()) {
            if (auth()->user()->role != null) {
                if (auth()->user()->role->role == 1) {
                    return $next($request);
                }
            }
            if (auth()->user()->interviewer != null) {
                if (auth()->user()->interviewer->isInterviewer($video->lesson->course->category->id)) {
                    return $next($request);
                }
            }

            if (auth()->user()->instructor != null) {
                if ($video != null) {
                    if (auth()->user()->instructor->id == $video->instructor->id) {
                        return $next($request);
                    }
                } else if ($exam != null) {
                    if (auth()->user()->instructor->id == $exam->course->instructor->id) {
                        return $next($request);
                    }
                }
            }

            if ($join == null) {
                if ($video != null) {
                    return redirect()->route('course.show', $video->lesson->course)->with('message', 'Your Have Not Purchase the Course');
                } else {
                    return redirect()->route('course.show', $exam->course)->with('message', 'Your Have Not Purchase the Course');
                }
            }
        }
        return $next($request);
    }
}
