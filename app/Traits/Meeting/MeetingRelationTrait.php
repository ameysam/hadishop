<?php

namespace App\Traits\Meeting;

use App\Models\Center;
use App\Models\CustomRole;
use App\Models\MeetingSchedule;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait MeetingRelationTrait
{
    /**
     * @return BelongsTo
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }

    /**
     * @return BelongsTo
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    /**
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function schedules()
    {
        return $this->hasMany(MeetingSchedule::class, 'meeting_id', 'id');
    }

    /**
     * @return BelongsToMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status_predicted', 'status_happened');
    }

    /**
     * @return BelongsToMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function roles()
    {
        return $this->belongsToMany(CustomRole::class, 'meeting_role', 'meeting_id', 'role_id');
    }

    /**
     * @return BelongsTo
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function secretary()
    {
        return $this->belongsTo(User::class, 'secretary_id', 'id');
    }
}
