<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockedUser
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
        if (auth()->user()->blocked_at != null) {
            auth()->logout();
            return redirect()->route('login')
                ->with('danger', 'Your account was blocked');
        }

        $user = $request->route('user');

        if ($user != null) {
            if ($user->blocked_at != null) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
