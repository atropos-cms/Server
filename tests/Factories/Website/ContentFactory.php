<?php

namespace Tests\Factories\Website;

use App\Models\Website\Content;
use Lukeraymonddowning\Poser\Factory;

/**
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Website\Content[]|\App\Models\Website\Content __invoke($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Website\Content[]|\App\Models\Website\Content create($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\Website\Content[]|\App\Models\Website\Content make($attributes = [])
 */
class ContentFactory extends Factory
{
    protected static $modelName = Content::class;
}
