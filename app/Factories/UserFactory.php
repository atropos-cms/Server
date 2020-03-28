<?php

namespace App\Factories;

use Laravel\Sanctum\Sanctum;
use App\Models\User as UserModel;

class UserFactory
{
    public function make($data = []): UserModel
    {
        return factory(UserModel::class)->make($data);
    }

    public function create($data = []): UserModel
    {
        return factory(UserModel::class)->create($data);
    }

    public function createWithAuthentication($data = []): UserModel
    {
        $user = factory(UserModel::class)->create($data);

        Sanctum::actingAs($user, ['*']);

        return $user;
    }
}
