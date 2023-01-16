<?php

namespace App\Models;

use App\Constants\Types\Permission\PermissionType;
use Spatie\Permission\Models\Permission;

class PermissionTitle extends Model
{
    protected $table = 'permission_titles';

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'title_id');
    }

    public function centerPermissions()
    {
        return $this->permissions()->where('type', PermissionType::PERMISSION_CENTER);
    }


    public function scopeWhereForSystem($query)
    {
        return $query->where('type', PermissionType::PERMISSION_SYSTEM);
    }

    public function scopeWhereForCenter($query)
    {
        return $query->where('type', PermissionType::PERMISSION_CENTER);
    }
}
