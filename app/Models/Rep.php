<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Rep extends Authenticatable
{
    use Notifiable;
    protected $table = 'reps';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'username', 'password', 'wallet_balance', 'status', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'wallet_balance' => 'decimal:2',
    ];

    /**
     * Get the users associated with this rep
     */
    public function users(){
        return $this->hasMany(User::class, 'rep_id');
    }

    /**
     * Get the contribution plans created by this rep
     */
    public function contributionPlans(){
        return $this->hasMany(ContributionPlan::class, 'rep_id');
    }

    /**
     * Get the transactions associated with this rep
     */
    public function transactions(){
        return $this->hasMany(Transaction::class, 'rep_id');
    }

    /**
     * Legacy relationship for backward compatibility
     */
    public function user(){
        return $this->hasMany(User::class, 'rep_id');
    }

    public function rep(){
        return $this->belongsTo(Rep::class, 'referral');
    }
}
