<?php

namespace App\Models;

use App\Traits\BelongsToOrganisation;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use BelongsToOrganisation;

    protected $guarded = [];

    public function productcat(){
        return $this->belongsTo('App\Models\Productcats');
    }

    public function subproductcat(){
        return $this->belongsTo('App\Models\Subproductcats');
    }
}
