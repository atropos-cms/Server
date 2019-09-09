<?php


namespace App\Factories;


use App\Models\User as UserModel;
use Laravel\Passport\Passport;

class UserFactory
{
    private $withAuthentication = true;

    public function withoutAuthentication()
    {
        $this->withAuthentication = false;
        return $this;
    }

    public function create() : UserModel
    {
        $user = factory(UserModel::class)->create();

        if ($this->withAuthentication) {
            Passport::actingAs($user);
        }

        return $user;
    }
}
