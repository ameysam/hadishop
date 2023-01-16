<?php

namespace App\Mixins;

class UrlGeneratorMixin
{
    public function googleMapUrl(): callable
    {
        return static function (float $lat, float $lng) {
            return "https://maps.google.com/?q={$lat},{$lng}";
        };
    }

    public function wazeMapUrl(): callable
    {
        return static function (float $lat, float $lng) {
            return "https://maps.google.com/?q={$lat},{$lng}";
        };
    }
}
