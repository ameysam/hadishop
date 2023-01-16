<?php


namespace App\Traits\User;

use App\Models\Center;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\Province;
use App\Models\ProvinceCity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserRelationTrait
{

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(ProvinceCity::class, 'city_id', 'id');
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class)->withPivot('status_predicted', 'status_happened');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function centers()
    {
        return $this->belongsToMany(Center::class);
    }

    public function centerCreator(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_creator_id', 'id');
    }
}
