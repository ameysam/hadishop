<?php

namespace App\Mixins;

use App\Constants\HttpCode;

class ResponseMixin
{
    public function apiResponse(): callable
    {
        return static function ($data, int $code = HttpCode::_200)
        {
            return response()->json($data, HttpCode::_200);
        };
    }
}
