<?php

namespace Tests\Factories\Website;

use App\Models\Website\Navigationentry;
use Lukeraymonddowning\Poser\Factory;

/**
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Website\Navigationentry[]|\App\Models\Website\Navigationentry __invoke($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Website\Navigationentry[]|\App\Models\Website\Navigationentry create($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Website\Navigationentry[]|\App\Models\Website\Navigationentry make($attributes = [])
 */
class NavigationentryFactory extends Factory
{
    protected static $modelName = Navigationentry::class;
}
