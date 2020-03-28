<?php

namespace App\GraphQL\Mutations;

use Hash;
use Laravel\Sanctum\Sanctum;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Validation\ValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Logout
{
    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param mixed[] $args The arguments that were passed into the field.
     * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context Arbitrary data that is shared between all fields of a single query.
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @throws ValidationException
     *
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $request = $context->request();
        $token = $request->bearerToken();

        $model = Sanctum::$personalAccessTokenModel;
        $accessToken = $model::where('token', hash('sha256', $token))->first();

        return [
            'status' => $accessToken->delete(),
        ];
    }
}
