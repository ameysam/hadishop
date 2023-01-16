<?php

namespace App\Models;

use Spatie\Permission\Models\Role;

class CustomRole extends Role
{
    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }

    public function isCenterAdmin()
    {
        return $this->slug == "admin-place";
    }

    public function scopeWhereCenter($query, $center)
    {
        $center_id = $center;
        if($center instanceof Center)
        {
            $center_id = $center->id;
        }

        return $query->where('center_id', $center_id);
    }
}
