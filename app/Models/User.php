<?php

namespace App\Models;

use App\Traits\BelongsToOrganisation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use BelongsToOrganisation;
    // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'org_id',
        'name',
        'username',
        'email',
        'accNum',
        'wallet_balance',
        'phone',
        'profession',
        'education',
        'address',
        'dob',
        'image',
        'status',
        'nok_name',
        'nok_phone',
        'nok_relationship',
        'password',
        'rep_id',
        'signature',
         'profile_pix'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'dob' => 'date',
        'wallet_balance' => 'float',
        'rep_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if (!$user->isDirty('rep_id') || !$user->rep_id) {
                return;
            }

            if (!app(\App\Services\TenantContext::class)->isResolved()) {
                return;
            }

            if (!Rep::where('id', $user->rep_id)->exists()) {
                $user->rep_id = $user->getOriginal('rep_id');
            }
        });
    }

    // Relationships

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction')->orderBy('id', 'DESC');
    }

    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet');
    }

    public function rep()
    {
        return $this->belongsTo('App\Models\Rep', 'rep_id');
    }

    public function contributionPlans()
    {
        return $this->hasMany('App\Models\ContributionPlan');
    }
}
