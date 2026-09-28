<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AllowAdminOrGhost
{
    /**
     * Allow the org admin, or a superadmin who has entered an org.
     * The organisation id is never read from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        if (Auth::guard('superadmin')->check() && $request->session()->has('acting_org_id')) {
            return $next($request);
        }

        if (Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.dashboard');
        }

        return redirect()->route('admin.login');
    }
}
