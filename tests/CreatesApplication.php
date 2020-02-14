<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        // create the test database if it does not exist
        if (!file_exists(env('DB_DATABASE'))) {
            touch(env('DB_DATABASE'));
        }

        return $app;
    }
}
