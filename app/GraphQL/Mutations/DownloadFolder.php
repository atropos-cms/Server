<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\URL;
use App\Models\Collaboration\Files\Folder;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class DownloadFolder
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
        $folder = Folder::findOrFail($args['id']);

        // Set the correct host part for tenant urls
        URL::formatHostUsing(fn () => 'http://' . tenant()->domains[0]);

        $validUntil = now()->addMinutes(5);
        $downloadLink = URL::temporarySignedRoute('files-download', $validUntil, [
            'folderId' => $folder->id,
        ]);

        return [
            'folder' => $folder,
            'validUntil' => $validUntil,
            'downloadLink' => $downloadLink,
        ];
    }
}
