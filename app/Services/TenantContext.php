<?php

namespace App\Services;

class TenantContext
{
    /**
     * The currently active organisation ID for this request.
     *
     * @var int|null
     */
    protected $orgId = null;

    /**
     * Set the active organisation for this request.
     *
     * @param  int  $orgId
     * @return void
     */
    public function set($orgId)
    {
        $this->orgId = (int) $orgId;
    }

    /**
     * Get the active organisation ID.
     *
     * @return int|null
     */
    public function get()
    {
        return $this->orgId;
    }

    /**
     * Check if a tenant context is currently active.
     *
     * @return bool
     */
    public function isResolved()
    {
        return $this->orgId !== null;
    }

    /**
     * Clear the active context.
     *
     * @return void
     */
    public function clear()
    {
        $this->orgId = null;
    }
}
