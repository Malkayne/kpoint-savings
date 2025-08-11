<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContributionPlan extends Model
{
    protected $table = 'contribution_plans';

    protected $fillable = [
        'user_id',
        'rep_id',
        'title',
        'amount',
        'description',
        'duration',
        'start_date',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'rep_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the user that owns this contribution plan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rep that created this contribution plan
     */
    public function rep()
    {
        return $this->belongsTo(Rep::class);
    }

    /**
     * Get the contributions for this plan
     */
    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'plan_id');
    }

    /**
     * Get the transactions for this plan
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'plan_id');
    }
} 