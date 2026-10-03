<?php

namespace App\Providers;

use App\Models\Organisation;
use App\Services\TenantContext;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TenantContext::class, function () {
            return new TenantContext();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $isSuperadmin = false;
            $actingOrgId = null;
            $actingOrg = null;

            try {
                if (isset(config('auth.guards')['superadmin']) && app()->bound('session')) {
                    $isSuperadmin = Auth::guard('superadmin')->check();
                    $actingOrgId = session('acting_org_id');

                    if ($isSuperadmin && $actingOrgId) {
                        $actingOrg = Organisation::find($actingOrgId);
                    }
                }
            } catch (\Exception $e) {
                $isSuperadmin = false;
                $actingOrgId = null;
                $actingOrg = null;
            }

            $view->with([
                'isSuperadminGhostMode' => $isSuperadmin && $actingOrgId !== null,
                'ghostOrg' => $actingOrg,
            ]);
        });
    }
}
