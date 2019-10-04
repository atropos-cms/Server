<?php

namespace App\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateUserValidationDirective extends ValidationDirective
{
    /**
     * Name of the directive.
     *
     * @return string
     */
    public function name(): string
    {
        return 'updateUserValidation';
    }

    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        $createUser = $this->resolveInfo->fieldName === 'createUser';

        if ($this->resolveInfo->fieldName === 'updateMe') {
            $ignore = auth()->user()->id;
        } else {
            $ignore = $this->args['id'] ?? null;
        }

        return [
            'first_name' => [Rule::requiredIf($createUser), 'string'],
            'last_name' => [Rule::requiredIf($createUser), 'string'],
            'email' => [
                Rule::requiredIf($createUser),
                'email',
                Rule::unique('users', 'email')->ignore($ignore, 'id')
            ]
        ];
    }
}
