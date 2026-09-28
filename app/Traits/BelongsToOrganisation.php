<?php

namespace App\Traits;

use App\Models\Organisation;
use App\Scopes\OrganisationScope;
use App\Services\TenantContext;

trait BelongsToOrganisation
{
    /**
     * Boot the trait. Called automatically by Laravel's model boot process.
     *
     * @return void
     */
    protected static function bootBelongsToOrganisation()
    {
        static::addGlobalScope(new OrganisationScope());

        static::creating(function ($model) {
            $orgId = app(TenantContext::class)->get();

            // A resolved request always wins, so a forged org_id cannot land in another organisation.
            if ($orgId) {
                $model->org_id = $orgId;
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('org_id')) {
                $model->org_id = $model->getOriginal('org_id');
            }
        });
    }

    /**
     * Relationship back to the owning organisation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'org_id');
    }

    /**
     * Escape the tenant scope for this query only.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function withoutTenantScope()
    {
        return static::withoutGlobalScope(OrganisationScope::class);
    }
}
