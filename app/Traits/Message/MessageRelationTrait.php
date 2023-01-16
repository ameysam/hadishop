<?php

namespace App\Traits\Message;

use App\Models\User;

trait MessageRelationTrait
{
    /**
     * @internal
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * @internal
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('seen_at', 'status');
    }

    public function messageable()
    {
        return $this->morphTo();
    }
}
