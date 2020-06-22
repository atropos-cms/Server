<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use App\Models\Collaboration\Files\Folder;
use Illuminate\Validation\ValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Folders
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
        // If the parent_id is not set, return only folders at the top level
        if (! isset($args['parent_id'])) {
            return Folder::where([
                'workspace_id' => $args['workspace_id'],
            ])->whereNull('parent_id')->get();
        }

        // Otherwise, return all folders nested under that parent
        $parentExists = Folder::where([
            'workspace_id' => $args['workspace_id'],
            'id' => $args['parent_id'],
        ])->exists();

        if (! $parentExists) {
            throw ValidationException::withMessages(['parent_id' =>  ['Could not find a folder matching the given parent_id']]);
        }

        return Folder::where([
            'workspace_id' => $args['workspace_id'],
            'parent_id' => $args['parent_id'],
        ])->get();
    }
}
