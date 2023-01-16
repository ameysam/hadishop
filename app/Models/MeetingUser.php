<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingUser extends Model
{
    public $timestamps = false;

    protected $table = 'meeting_user';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
