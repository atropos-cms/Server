<?php

namespace Tests\Unit\Rules;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MatchOldPasswordTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_false_if_no_user_is_authenticated()
    {
        $rule = new MatchOldPassword();

        $this->assertFalse($rule->passes('password', 'secret'));
    }

    /** @test */
    public function it_tests_a_string_against_the_current_users_password()
    {
        $user = factory(User::class)->create(['password' => \Hash::make('secret')]);
        auth()->setUser($user);

        $rule = new MatchOldPassword();

        $this->assertTrue($rule->passes('password', 'secret'));
    }

    /** @test */
    public function it_returns_a_validation_message()
    {
        $rule = new MatchOldPassword();

        $this->assertEquals('validation.invalid_password', $rule->message());
    }
}
