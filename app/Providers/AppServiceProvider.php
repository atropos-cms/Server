<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Airlock\Airlock;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Airlock::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
