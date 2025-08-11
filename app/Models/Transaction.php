<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'rep_id',
        'plan_id',
        'wallet_type',
        'type',
        'amount',
        'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns this transaction
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the rep associated with this transaction
     */
    public function rep(){
        return $this->belongsTo(Rep::class);
    }

    /**
     * Get the contribution plan associated with this transaction
     */
    public function plan(){
        return $this->belongsTo(ContributionPlan::class, 'plan_id');
    }
}
