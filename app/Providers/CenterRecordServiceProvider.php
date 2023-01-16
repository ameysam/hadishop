<?php

namespace App\Providers;

use App\Models\Center;
use App\Services\Center\Admin\CenterRecord;
use Illuminate\Support\ServiceProvider;


class CenterRecordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Center::class, function (){

            $sms = new CenterRecord();

            return $sms->center();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
