<?php

namespace App\Traits\Message;

use App\Models\Message;

trait MessageableTrait
{
    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }
}
