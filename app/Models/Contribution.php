<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $table = 'contributions';

    protected $fillable = [
        'plan_id',
        'amount',
        'contributed_on'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'contributed_on' => 'date',
    ];

    /**
     * Get the contribution plan that owns this contribution
     */
    public function plan()
    {
        return $this->belongsTo(ContributionPlan::class, 'plan_id');
    }
} 