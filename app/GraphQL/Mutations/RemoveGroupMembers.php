<?php

namespace App\GraphQL\Mutations;

use App\Models\Group;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class RemoveGroupMembers
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        /** @var Group $group */
        $group = Group::findById($args['id']);

        // Remove users from the input array, that are not a member of the group.
        $currentMembers = collect($group->users()->pluck('id'));
        $newMembers = collect($args['members'])
            ->filter(fn ($item) => $currentMembers->contains($item))
            ->toArray();

        $group->users()->detach($args['members']);

        return $group;
    }
}
