<?php


namespace App\Models;

use App\Traits\BelongsToOrganisation;
use Illuminate\Database\Eloquent\Model;

class pendTransactions extends Model
{
    use BelongsToOrganisation;

        protected $table = 'pendTrans';

      protected $guarded = [];


     public function user(){
       return $this->belongsTo('App\Models\User');
     }
}
