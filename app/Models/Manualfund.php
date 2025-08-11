<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manualfund extends Model
{

     protected $table = 'manual_funding_requests';
     
      protected $guarded =[];


  public function user()
    {
        return $this->belongsTo(User::class);
    }

  
} 