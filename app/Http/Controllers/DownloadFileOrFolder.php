<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Collaboration\Files\File;
use App\Models\Collaboration\Files\Folder;
use Spatie\TemporaryDirectory\TemporaryDirectory;

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

        return Storage::download('files/' . $file->storage_path, $file->original_filename);
    }

    private function downloadFolder(Request $request)
    {
        $folder = Folder::findOrFail($request->get('folderId'));

        $zip = new ZipArchive();
        $temporaryDirectory = (new TemporaryDirectory())->create();

        $path = $temporaryDirectory->path('temp.zip');

        if ($zip->open($path, ZipArchive::CREATE) === true) {
            $this->addFolderContentToZip($zip, $folder);
            $zip->close();
        }

        return response()->download($path);
    }

    private function addFolderContentToZip(ZipArchive $zip, Folder $folder, $path = '')
    {
        foreach ($folder->children as $childFolder) {
            $zip->addEmptyDir($path . $childFolder->name . '/');
            $this->addFolderContentToZip($zip, $childFolder, $path . $childFolder->name . '/');
        }

        foreach ($folder->files as $file) {
            $zip->addFile(Storage::path('files/' . $file->storage_path), $path . $file->original_filename);
        }
    }
}
