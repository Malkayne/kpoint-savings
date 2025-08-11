<?php

namespace App\Http\Middleware;

use Closure;

class RedirectTo503
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
        abort(503, 'Service Unavailable');
    }
}
