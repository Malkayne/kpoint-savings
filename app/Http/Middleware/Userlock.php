<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Userlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect('/login');
        }

        if ($user->status == 'inactive') {
            Auth::guard('web')->logout();
            return redirect('/login')->with('error', 'Account suspended, contact admin or rep to unlock account');
        }

        return $next($request);
    }
}
