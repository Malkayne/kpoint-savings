<?php

namespace App\Http\Middleware;

use App\Services\TenantContext;
use Closure;
use Illuminate\Support\Facades\Auth;

class ResolveTenant
{
    /**
     * @var \App\Services\TenantContext
     */
    protected $context;

    public function __construct(TenantContext $context)
    {
        $this->context = $context;
    }

    /**
     * Resolve the current organisation onto TenantContext.
     * Authenticated groups abort when no org can be determined.
     * Org is never taken from the query string or form input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Use only the guard for this route. Another login in the same
        // browser must not pull these screens into a different organisation.
        if ($guard === 'admin') {
            if (Auth::guard('admin')->check()) {
                return $this->applyOrAbort(Auth::guard('admin')->user()->org_id, $next, $request);
            }

            if ($this->superadminIsActing() && $request->session()->has('acting_org_id')) {
                return $this->applyOrAbort($request->session()->get('acting_org_id'), $next, $request);
            }

            abort(403, 'Tenant context could not be resolved.');
        }

        if (!in_array($guard, ['web', 'rep', 'manager'], true) || !Auth::guard($guard)->check()) {
            abort(403, 'Tenant context could not be resolved.');
        }

        return $this->applyOrAbort(Auth::guard($guard)->user()->org_id, $next, $request);
    }

    /**
     * Set the tenant or abort when the resolved org id is empty.
     *
     * @param  mixed  $orgId
     * @param  \Closure  $next
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function applyOrAbort($orgId, Closure $next, $request)
    {
        if (!org_is_active($orgId)) {
            abort(403, 'This organisation is not active.');
        }

        $this->context->set($orgId);

        return $next($request);
    }

    /**
     * Superadmin guard is added in Sprint 3; only call it when configured.
     *
     * @return bool
     */
    protected function superadminIsActing()
    {
        $guards = config('auth.guards', []);

        if (!isset($guards['superadmin'])) {
            return false;
        }

        return Auth::guard('superadmin')->check();
    }
}
