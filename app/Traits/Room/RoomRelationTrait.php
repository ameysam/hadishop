<?php

namespace App\Traits\Room;

use App\Models\Center;
use App\Models\Meeting;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Role;

trait RoomRelationTrait
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
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }


    /**
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'room_id', 'id');
    }
}
