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

Route::get('/download-file', 'DownloadFile')->name('download-file');

Route::get('{uri}', function () {
    return file_get_contents(public_path('app/index.html'));
})->where('uri', '.*');
