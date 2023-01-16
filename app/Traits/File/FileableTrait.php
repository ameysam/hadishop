<?php

namespace App\Traits\File;

use App\Models\File;
use Illuminate\Database\Eloquent\SoftDeletes;

trait FileableTrait
{
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
