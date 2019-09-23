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
        if ($this->resolveInfo->fieldName === 'updateMe') {
            $ignore = auth()->user()->id;
        } else {
            $ignore = $this->args['id'];
        }

        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($ignore, 'id')
            ]
        ];
    }
}
