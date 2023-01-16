<?php


namespace App\Traits\User;

use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;

trait UserScopeTrait
{
    public function scopeWhereActivationMobile($query)
    {
        return $query->where('activation_type', UserActivationType::USER_ACTIVATION_MOBILE);
    }

    public function scopeWhereActivationEmail($query)
    {
        return $query->where('activation_type', UserActivationType::USER_ACTIVATION_EMAIL);
    }

    public function scopeWhereUnActive($query)
    {
        return $query->where('activation_status', UserActivationStatusType::USER_ACTIVATION_STATUS_UNACTIVE);
    }

    public function scopeWhereActivationToken($query, string $token)
    {
        return $query->where('activation_token', $token);
    }
}
