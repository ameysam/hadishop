<?php


namespace App\Traits\User;

use Illuminate\Support\Str;


trait UserMutatorTrait
{
    /**
     * Set Password attribute to encode.
     *
     * @param $value
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setPasswordAttribute($value): void
    {
        // $this->attributes['password'] = null;
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Remove country code from mobile number and replace it by zero value.
     *
     * @param $value
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function setMobileNoAttribute($value): void
    {
        $this->attributes['mobile_no'] = Str::removeCountryCodeFromMobileNo($value);
    }
}
