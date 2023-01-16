<?php

namespace App\Traits\Schedule;

use App\Models\Center;
use App\Models\Room;
use App\Models\ScheduleDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ScheduleRelationTrait
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
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function details()
    {
        return $this->hasMany(ScheduleDetail::class, 'schedule_id', 'id');
    }

    /**
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'schedule_id', 'id');
    }
}
