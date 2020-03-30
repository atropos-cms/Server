<?php

namespace App\GraphQL\Directives;

use App\Rules\MatchOldPassword;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateUserPasswordValidationDirective extends ValidationDirective
{
    /**
     * Name of the directive.
     *
     * @return string
     */
    public function name(): string
    {
        return 'updateUserPasswordValidation';
    }

    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', new MatchOldPassword()],
            'password' => ['required', 'confirmed'],
        ];
    }
}
