<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use App\Models\Collaboration\Files\Workspace;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AddRoleToWorkspace
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        /** @var Workspace $workspace */
        $workspace = Workspace::find($args['id']);

        // Remove roles from the input array, that are already present in the workgroup.
        $currentRoles = collect($workspace->roles()->pluck('roles.id'));
        $newRoles = collect($args['roles'])
            ->filter(fn ($item) => ! $currentRoles->contains($item))
            ->toArray();

        $workspace->roles()->attach($newRoles);

        return $workspace;
    }
}
