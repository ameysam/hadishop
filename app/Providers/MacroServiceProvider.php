<?php

namespace App\Providers;

use App\Mixins\ArrMixin;
use App\Mixins\ResponseMixin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Routing\Router;
use App\Mixins\RouterMixin;
use App\Mixins\StrMixin;
use App\Mixins\UrlGeneratorMixin;
use Illuminate\Http\Response;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Arr;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Str::mixin(new StrMixin);

        Router::mixin(new RouterMixin);

        Arr::mixin(new ArrMixin);

        UrlGenerator::mixin(new UrlGeneratorMixin);

        Response::mixin(new ResponseMixin);
    }
}
