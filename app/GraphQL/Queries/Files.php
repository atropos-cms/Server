<?php

namespace App\GraphQL\Queries;

use App\Models\Collaboration\Files\File;
use GraphQL\Type\Definition\ResolveInfo;
use App\Models\Collaboration\Files\Folder;
use Illuminate\Validation\ValidationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Files
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
        // If the parent_id is not set, return only files at the top level
        if (! isset($args['parent_id'])) {
            return File::where([
                'workspace_id' => $args['workspace_id'],
            ])->whereNull('parent_id')->get();
        }

        // Otherwise, return all files nested under that parent
        $parentExists = Folder::where([
            'workspace_id' => $args['workspace_id'],
            'id' => $args['parent_id'],
        ])->exists();

        if (! $parentExists) {
            throw ValidationException::withMessages(['parent_id' =>  ['Could not find a folder matching the given parent_id']]);
        }

        return File::where([
            'workspace_id' => $args['workspace_id'],
            'parent_id' => $args['parent_id'],
        ])->get();
    }
}
