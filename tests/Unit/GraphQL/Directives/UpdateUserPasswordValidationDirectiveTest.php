<?php

namespace Tests\Unit\GraphQL\Directives;

use App\GraphQL\Directives\UpdateUserPasswordValidationDirective;
use Tests\TestCase;

class UpdateUserPasswordValidationDirectiveTest extends TestCase
{
    /** @test */
    public function directive_has_a_name()
    {
        $directive = app(UpdateUserPasswordValidationDirective::class);

        $this->assertEquals('updateUserPasswordValidation', $directive->name());
    }
}
