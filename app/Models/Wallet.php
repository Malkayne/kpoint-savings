<?php

namespace App\Models;

use App\Traits\BelongsToOrganisation;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use BelongsToOrganisation;

     protected $guarded = [];
}
