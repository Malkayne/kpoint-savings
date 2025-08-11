<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      if (Auth::guard($guard)->check()) {
        if($guard == "admin"){
            return redirect(route('admin.dashboard'));
        }elseif($guard == "rep"){
          return redirect(route('rep.dashboard'));
        }elseif($guard == "manager"){
          return redirect(route('manager.dashboard'));
        }else{
          return redirect(route('userend.dashboard'));
        }
        
      }

      return $next($request);
    }

}
