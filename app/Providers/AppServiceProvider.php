<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \Schema::defaultStringLength(191);

        Blade::if('master', function () {
            return is('master');
        });
        Blade::if('organ', function () {
            return is('organ');
        });
        Blade::if('regular_user', function () {
            return is('user');
        });
        Blade::if('admins', function () {
            return is('master') || is('expert');
        });
        Blade::if('admins_or_organ', function () {
            return is('master') || is('expert') || is('organ');
        });
    }
}
