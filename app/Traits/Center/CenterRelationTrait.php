<?php

namespace App\Traits\Center;

use App\Models\CenterType;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role;

trait CenterRelationTrait
{
    /**
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'center_id', 'id');
    }

    /**
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function roles()
    {
        return $this->hasMany(Role::class, 'center_id', 'id');
    }

    /**
     * @return BelongsTo
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function type()
    {
        return $this->belongsTo(CenterType::class, 'type_id', 'id');
    }

    /**
     * @return BelongsToMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
