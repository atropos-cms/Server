<?php

namespace App\Http\Controllers;

use App\Models\Collaboration\Files\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Collaboration\Files\File;

class DownloadFileOrFolder extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has('fileId')) {
            return $this->downloadFile($request);
        }

        return $this->downloadFolder($request);
    }

    private function downloadFile(Request $request)
    {
        $file = File::findOrFail($request->get('fileId'))->first();

        return Storage::download('files/' . $file->storage_path);
    }

    private function downloadFolder(Request $request)
    {
        $folder = Folder::findOrFail($request->get('folderId'));

        dump($folder);

        return Storage::download('files/' . $file->storage_path);
    }
}
