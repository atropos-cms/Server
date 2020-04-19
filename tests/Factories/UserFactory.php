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

    /**
     * @param string $permission
     *
     * @return $this
     */
    public function withPermission(string $permission)
    {
        $permissionModel = PermissionFactory::new()->make(['name' => $permission]);

        $this->afterCreating(fn (User $user) => $user->permissions()->save($permissionModel));

        return $this;
    }

    /**
     * @param string $permission
     *
     * @return $this
     */
    public function authenticateWithPermission(string $permission)
    {
        return $this->withAuthentication()->withPermission($permission);
    }
}
