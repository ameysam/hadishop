<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    public function getPath()
    {
        return config('filesystems.files_link') . "/{$this->uploaded_name}";
    }
}
