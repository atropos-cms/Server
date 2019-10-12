<?php

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here is where you can register tenant routes for your application. These
| routes are loaded by the TenantRouteServiceProvider within a group
| which contains the "InitializeTenancy" middleware. Good luck!
|
*/

Route::get('/app', function () {
    return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
});
