<?php

namespace Tests\Unit\GraphQL\Directives;

use Tests\TestCase;
use App\GraphQL\Directives\UpdateUserPasswordValidationDirective;

class UpdateUserPasswordValidationDirectiveTest extends TestCase
{
    /** @test */
    public function directive_has_a_name()
    {
        $directive = app(UpdateUserPasswordValidationDirective::class);

        $this->assertEquals('updateUserPasswordValidation', $directive->name());
    }
}
