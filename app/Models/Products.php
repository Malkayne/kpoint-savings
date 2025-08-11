<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $guarded = [];

    public function productcat(){
        return $this->belongsTo('App\Models\Productcats');
    }

    public function subproductcat(){
        return $this->belongsTo('App\Models\Subproductcats');
    }
}
