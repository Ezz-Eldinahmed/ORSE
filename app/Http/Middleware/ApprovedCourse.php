<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovedCourse
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
        $course = $request->route('course');

        if ($course->approved == 1) {
            return $next($request);
        }
        if (Auth::check() && auth()->user()->role != null) {
            if (auth()->user()->role->role == 1) {
                return $next($request);
            }
        }
        if (auth()->user()->interviewer != null) {
            if (auth()->user()->interviewer->isInterviewer($course->category->id)) {
                return $next($request);
            }
        }
        if (auth()->user()->instructor != null) {
            $inst = auth()->user()->instructor;
            if ($course->instructor->id == $inst->id && $inst->approved == 1) {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
