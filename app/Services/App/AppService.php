<?php

namespace App\Services\App;

class AppService
{
    public static function inProduction(): bool
    {
        return in_array(config('app.env'), ['prod', 'production']);
    }

    public static function inLocal(): bool
    {
        return ! self::inProduction();
    }

    public static function sha256($string)
    {
        return hash('sha256', $string);
    }
}
