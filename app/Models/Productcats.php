<?php

namespace App\Models;

use App\Traits\BelongsToOrganisation;
use Illuminate\Database\Eloquent\Model;

class Productcats extends Model
{
    use BelongsToOrganisation;

    protected $guarded = [];

    // public function subproductcats(){
    // return $this->hasMany('App\Models\Subproductcats','productcat_id');
    // }

}
