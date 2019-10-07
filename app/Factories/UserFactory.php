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

    public function make($data = []) : UserModel
    {
       return factory(UserModel::class)->make();
    }

    public function create($data = []) : UserModel
    {
        $user = factory(UserModel::class)->create($data);

        if ($this->withAuthentication) {
            Passport::actingAs($user);
        }

        return $user;
    }
}
