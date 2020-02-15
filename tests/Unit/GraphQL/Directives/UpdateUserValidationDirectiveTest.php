<?php

namespace Tests\Unit\GraphQL\Directives;

use Tests\TestCase;
use App\GraphQL\Directives\UpdateUserValidationDirective;

class UpdateUserValidationDirectiveTest extends TestCase
{
    /** @test */
    public function directive_has_a_name()
    {
        $directive = app(UpdateUserValidationDirective::class);

        $this->assertEquals('updateUserValidation', $directive->name());
    }
}
