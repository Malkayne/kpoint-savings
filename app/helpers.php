<?php

use App\Services\TenantContext;

if (!function_exists('current_org_id')) {
    /**
     * The organisation id resolved for this request, or null.
     *
     * @return int|null
     */
    function current_org_id()
    {
        return app(TenantContext::class)->get();
    }
}

if (!function_exists('org_is_active')) {
    /**
     * True only when this organisation exists and is allowed to operate.
     *
     * @param  mixed  $orgId
     * @return bool
     */
    function org_is_active($orgId)
    {
        if ($orgId === null || $orgId === '') {
            return false;
        }

        $org = \App\Models\Organisation::find($orgId);

        return $org && $org->status === 'active';
    }
}
