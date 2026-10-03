<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Replock
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
        $rep = Auth::guard('rep')->user();

        if (!$rep) {
            return redirect('/rep/login');
        }

        // Live reps table locks via status (active/inactive), not is_lock.
        if ($rep->status === 'inactive') {
            Auth::guard('rep')->logout();
            return redirect('/rep/login')->with('error', 'Account suspended,contact admin to unlock account');
        }

        return $next($request);
    }
}
