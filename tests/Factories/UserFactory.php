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
     * @param string|array $permissions
     *
     * @return $this
     */
    public function withPermissions($permissions)
    {
        if (! is_array($permissions)) {
            $permissions = [$permissions];
        }

        foreach ($permissions as $permission) {
            $permissionModel = PermissionFactory::new()->make(['name' => $permission]);

            $this->afterCreating(fn (User $user) => $user->permissions()->save($permissionModel));
        }

        return $this;
    }

    /**
     * @param string|array $permission
     * @param mixed $permissions
     *
     * @return $this
     */
    public function authenticateWithPermissions($permissions)
    {
        return $this->withAuthentication()->withPermissions($permissions);
    }
}
