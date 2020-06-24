<?php

namespace App\Http\Controllers;

use App\Models\Collaboration\Files\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadFile extends Controller
{
    public function __invoke(Request $request)
    {
        $file = File::findOrFail($request->get('fileId'));

        return Storage::download('files/' . $file->storage_path);
    }
}
