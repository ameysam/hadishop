<?php

namespace App\Traits\Guest;

use App\Models\Guest;

trait GuestableTrait
{
    public function guests()
    {
        return $this->morphMany(Guest::class, 'guestable');
    }
}
