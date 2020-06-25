<?php

namespace App\Http\Controllers\Api;

use App\DictionaryFile;
use App\File;
use App\Http\Resources\File as FileResource;
use App\Http\Controllers\Controller;
use App\TextFile;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function index()
    {
        $files = $this->authApiUser()->files;
        return FileResource::collection($files);
    }

    public function show($id)
    {
        $file = $this->authApiUser()->files()->findOrFail($id);

        return new FileResource($file);
    }

    public function showFolderFiles($id)
    {
        $folderFiles = $this->authApiUser()->folders()->findOrFail($id)->files;

        return FileResource::collection($folderFiles);
    }

    public function store(Request $request)
    {
        if (!isset($request->folder_id) || !isset($request->name)) abort(400);

        $this->authApiUser()->folders()->findOrFail($request->folder_id);

        $file = new File();
        $file->folder_id = $request->folder_id;
        $file->name = $request->name;

        // TYPE HAS TO BE: lowercase, only file type (without suffix "file")
        switch ($request->type) {
            case 'text':
                $textFile = TextFile::create(['content' => '']);
                if ($textFile->file()->save($file)) return new FileResource($file);
                break;
            case 'dictionary':
                $dictFile = DictionaryFile::create();
                if ($dictFile->file()->save($file)) return new FileResource($file);
                break;
        }
    }

    // THIS UPDATES ONLY FILE NAME, AND FOLDER_ID
    public function update(Request $request, $id)
    {
        $file = $this->authApiUser()->files()->findOrFail($id);

        if (isset($request->name)) $file->name = $request->name;
        if (isset($request->folder_id)) $file->folder_id = $request->folder_id;

        if ($file->save()) {
            return new FileResource($file);
        }
    }

    public function destroy($id)
    {
        $file = $this->authApiUser()->files()->findOrFail($id);

        if ($file->delete()) {
            return new FileResource($file);
        }
    }
}
