<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    /**
     * @return HasMany
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function cities()
    {
        return $this->hasMany(ProvinceCity::class, 'province_id', 'id');
    }
}
