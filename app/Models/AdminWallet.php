<?php

namespace App\Models;

use App\Traits\BelongsToOrganisation;
use Illuminate\Database\Eloquent\Model;

class AdminWallet extends Model
{
    use BelongsToOrganisation;

    protected $table = 'admin_wallets';

    protected $fillable = [
        'org_id',
        'admin_id',
        'amount'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'admin_id' => 'integer',
    ];

    /**
     * Get the admin that owns this wallet
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
