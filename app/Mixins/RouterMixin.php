<?php

namespace App\Mixins;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouterMixin
{
    public function actionName(): callable
    {
        return static function ($action_name = null) {
            list(, $action) = explode('@', Route::current()->getActionName());
            if($action_name)
            {
                return $action == $action_name;
            }
            return $action;
        };
    }

    public function getParam(): callable
    {
        return static function ($name) {
            $route = Route::current();
            if($name != null && $route != null)
            {
                return $route->parameter($name);
            }
            return null;
        };
    }

    public function isMethod(): callable
    {
        return static function ($type) {
            return request()->method() == Str::upper($type);
        };
    }
}
