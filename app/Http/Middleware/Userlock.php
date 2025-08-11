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
        $user = Auth::user('user');
        
        if($user->status == 'inactive'){
            Auth::logout();
            return redirect('/login')->with('error','Account suspended, contact admin or rep to unlock account');
        }
        return $next($request);
    }
}
