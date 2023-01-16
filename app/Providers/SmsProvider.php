<?php

namespace App\Providers;

use App\Services\Sms\Contracts\Sms;
use App\Services\Sms\Contracts\SmsFactory;
use Illuminate\Support\ServiceProvider;

class SmsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function register()
    {
        $this->app->singleton(Sms::class, function (){

            $sms = new SmsFactory(config('services.sms.provider'));

            return $sms->provider();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function boot()
    {
        //
    }
}
