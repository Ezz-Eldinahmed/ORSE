<?php

namespace App\Http\Middleware;

use App\Models\Reply;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyOwner
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
        $reply = $request->route('reply');

        if (Auth::check()) {
            if (auth()->user()->id == $reply->user->id) {
                return $next($request);
            }
        }
    }
}
