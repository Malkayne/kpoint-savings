<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'organisations';

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'address',
        'logo',
        'status',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'org_id');
    }

    public function managers()
    {
        return $this->hasMany(Manager::class, 'org_id');
    }

    public function reps()
    {
        return $this->hasMany(Rep::class, 'org_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'org_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'org_id');
    }

    public function contributionPlans()
    {
        return $this->hasMany(ContributionPlan::class, 'org_id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class, 'org_id');
    }

    public function manualFunds()
    {
        return $this->hasMany(Manualfund::class, 'org_id');
    }

    public function adminWallet()
    {
        return $this->hasOne(AdminWallet::class, 'org_id');
    }

    public function productcats()
    {
        return $this->hasMany(Productcats::class, 'org_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'org_id');
    }

    public function pendingTransactions()
    {
        return $this->hasMany(pendTransactions::class, 'org_id');
    }

    /**
     * Check if this organisation is active and can be accessed
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get total wallet balance across all users in this org
     */
    public function totalUserWalletBalance()
    {
        return (float) $this->users()->sum('wallet_balance');
    }

    /**
     * Get total number of active users
     */
    public function activeUserCount()
    {
        return $this->users()->where('status', 'active')->count();
    }
}
