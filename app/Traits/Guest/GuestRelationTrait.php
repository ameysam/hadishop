<?php

namespace App\Traits\Guest;

trait GuestRelationTrait
{
    public function Guestable()
    {
        return $this->morphTo();
    }
}
