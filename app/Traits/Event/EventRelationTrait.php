<?php

namespace App\Traits\Event;

use App\Models\Center;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait EventRelationTrait
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
     * @return BelongsToMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
