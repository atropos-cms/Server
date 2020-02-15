<?php

namespace App\Providers;

use Laravel\Airlock\Airlock;
use Stancl\Tenancy\TenantManager;
use Illuminate\Support\ServiceProvider;

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
        // spatie/laravel-permission caches permissions & roles to save DB queries,
        // which means that we need to separate the permission cache by tenant.
        tenancy()->hook('bootstrapped', function (TenantManager $tenantManager) {
            \Spatie\Permission\PermissionRegistrar::$cacheKey = 'spatie.permission.cache.tenant.' . $tenantManager->getTenant('id');
        });
    }
}
