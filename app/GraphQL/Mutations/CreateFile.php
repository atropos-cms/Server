<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Storage;
use App\Models\Collaboration\Files\File;
use GraphQL\Type\Definition\ResolveInfo;
use App\Models\Collaboration\Files\Folder;
use App\Models\Collaboration\Files\Workspace;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateFile
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
        $file = File::make($args);

        $workspace = Workspace::findOrFail($args['workspace']['connect']);
        $file->workspace()->associate($workspace);

        if (isset($args['parent']['connect'])) {
            $parent = Folder::findOrFail($args['parent']['connect']);
            $file->parent()->associate($parent);
        }

        /** @var \Illuminate\Http\UploadedFile $fileInput */
        $fileInput = $args['file'];
        $file->name = $file->name ?? pathinfo($fileInput->getClientOriginalName(), PATHINFO_FILENAME);
        $file->mime_type = $fileInput->getMimeType();
        $file->original_filename = $fileInput->getClientOriginalName();
        $file->file_extension = $fileInput->getClientOriginalExtension();
        $file->size = $fileInput->getSize();
        $file->sha256_checksum = hash('sha256', $fileInput->get());

        $file->save();

        // Save file to disk
        Storage::putFileAs('files', $fileInput, $file->storage_path);

        return $file;
    }
}
