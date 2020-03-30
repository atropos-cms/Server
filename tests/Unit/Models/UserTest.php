<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Tests\UsesTenant;

class UserTest extends TestCase
{
    use UsesTenant;

    /** @test */
    public function it_computes_the_initials_for_a_user_based_on_the_first_and_last_name()
    {
        $user = factory(User::class)->make([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
        ]);
        $this->assertEquals('JD', $user->initials);

        /** @var User $user */
        $user = factory(User::class)->make();
        $initials = substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1);

        $this->assertEquals($initials, $user->initials);
    }

    /** @test */
    public function it_computes_the_full_name_for_a_user_based_on_the_first_and_last_name()
    {
        /** @var User $user */
        $user = factory(User::class)->make();

        $this->assertEquals("{$user->first_name} {$user->last_name}", $user->full_name);
    }
}
