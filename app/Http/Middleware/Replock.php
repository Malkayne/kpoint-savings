<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        $rep = Auth::user('rep');
        
        if($rep->is_lock){
            Auth::logout();
            return redirect('/rep/login')->with('error','Account suspended,contact admin to unlock account');
        }
        return $next($request);
    }
}
