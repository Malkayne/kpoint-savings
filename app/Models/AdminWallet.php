<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminWallet extends Model
{
    protected $table = 'admin_wallets';

    protected $fillable = [
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
