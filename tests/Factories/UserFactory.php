<?php

namespace Tests\Factories;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Lukeraymonddowning\Poser\Factory;

/**
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\User[]|\App\Models\User __invoke($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\User[]|\App\Models\User create($attributes = [])
 * @method \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection|\App\Models\User[]|\App\Models\User make($attributes = [])
 */
class UserFactory extends Factory
{
    /**
     * @return $this
     */
    public function withAuthentication()
    {
        $this->afterCreating(fn (User $user) => Sanctum::actingAs($user, ['*']));

        return $this;
    }
}
