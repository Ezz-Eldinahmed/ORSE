<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Interviewer
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
            if (auth()->user()->interviewer != null) {
                if (auth()->user()->interviewer->approved == 1) {
                    return $next($request);
                }
            } else if (Auth::user()->role != null) {
                if (auth()->user()->role->role == 1) {
                    return $next($request);
                }
            }
        }
        return redirect('/');
    }
}
