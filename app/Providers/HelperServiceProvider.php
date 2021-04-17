<?php

namespace App\Providers;

use App\DynamicTable\Components\DynamicTable;
use App\Helper\Gateway;
use App\Helper\Sms;
use App\Helper\Responser;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('responser', function () {
            return new Responser();
        });
        $this->app->bind('gateway', function () {
            return new Gateway();
        });
        $this->app->bind('sms', function () {
            return new Sms();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
    */
    public function boot()
    {
        Blade::component('dynamic-table', DynamicTable::class);
    }
}