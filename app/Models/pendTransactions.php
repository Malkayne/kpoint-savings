<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendTransactions extends Model
{
    //
    
        protected $table = 'pendTrans';

      protected $guarded = [];


     public function user(){
       return $this->belongsTo('App\Models\User');
     }
}
