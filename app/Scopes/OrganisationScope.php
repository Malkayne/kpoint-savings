<?php

namespace App\Scopes;

use App\Services\TenantContext;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrganisationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     * Callers that use orWhere must wrap those conditions in a closure,
     * otherwise SQL OR precedence can skip this organisation filter.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $context = app(TenantContext::class);

        if ($context->isResolved()) {
            $builder->where($model->getTable().'.org_id', $context->get());
        }
    }
}
