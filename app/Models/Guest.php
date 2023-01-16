<?php

namespace App\Models;

use App\Traits\Guest\GuestRelationTrait;

class Guest extends Model
{
    use
        GuestRelationTrait
    ;

    public $timestamps = false;
}
