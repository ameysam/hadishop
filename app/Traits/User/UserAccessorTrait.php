<?php


namespace App\Traits\User;

use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;
use App\Constants\Types\User\UserGenderType;
use App\Project;
use App\Constants\Types\User\UserNationalityType;
use App\Constants\Types\User\UserRegisterStatusType;
use App\Types\User\UserRestrictionType;
use App\Types\User\UserSectionType;
use ReflectionException;

trait UserAccessorTrait
{

    /**
     * @return string|null|array
     * @throws ReflectionException
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getActivationStatusFaAttribute()
    {
        if(!empty($this->activation_status))
        {
            return UserActivationStatusType::getValue($this->activation_status);
        }
        return null;
    }

    /**
     * @return string|null|array
     * @throws ReflectionException
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getActivationTypeFaAttribute()
    {
        if(!empty($this->activation_type))
        {
            return UserActivationType::getValue($this->activation_type);
        }
        return null;
    }


    /**
     * Return full name the user.
     *
     * @return string
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getFullNameAttribute(): string
    {
        if(!empty($this->attributes['first_name']) && $this->attributes['last_name'])
        {
            return "{$this->attributes['first_name']} {$this->attributes['last_name']}";
        }
        return '';
    }

    /**
     * @return string|null
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getGenderFaAttribute()
    {
        if(!empty($this->gender))
        {
            return UserGenderType::getValue($this->gender);
        }
        return null;
    }


    /**
     * @return string|null
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getBirthdateFaAttribute()
    {
        if(!empty($this->birthdate))
        {
            return jdate($this->birthdate)->format('Y/m/d');
        }
        return null;
    }
}
