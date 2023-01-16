<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProvinceCity extends Model
{
    /**
     * Table name.
     * @var string
     */
    protected $table = 'province_cities';


    /**
     * @return BelongsTo
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
