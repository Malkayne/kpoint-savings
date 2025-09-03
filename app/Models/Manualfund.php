<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manualfund extends Model
{

     protected $table = 'manual_funding_requests';
     
     protected $guarded = [];
     
     protected $casts = [
         'amount' => 'decimal:2',
     ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }
     
     /**
      * Check if the manual funding request status can be updated
      */
     public function canUpdateStatus()
     {
         return in_array($this->status, ['pending', 'ongoing']);
     }
     
     /**
      * Get the status badge class for display
      */
     public function getStatusBadgeClass()
     {
         switch ($this->status) {
             case 'pending':
                 return 'bg-warning';
             case 'ongoing':
                 return 'bg-info';
             case 'done':
                 return 'bg-success';
             case 'reversed':
                 return 'bg-secondary';
             case 'failed':
                 return 'bg-danger';
             default:
                 return 'bg-secondary';
         }
     }
} 