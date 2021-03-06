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

Route::middleware([
    \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
    \Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain::class,
])->group(function () {
    Route::get('/files-download', 'DownloadFileOrFolder')->name('files-download');

    Route::get('{uri}', function () {
        return file_get_contents(public_path('app/index.html'));
    })->where('uri', '.*');
});
