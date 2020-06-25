<?php

namespace App\Http\Controllers\Api;

use App\Folder;
use App\Http\Controllers\Controller;
use App\Http\Resources\Folder as FolderResource;
use Illuminate\Http\Request;

class FolderController extends Controller
{

    public function index()
    {
        $folders = $this->authApiUser()->folders()->get()->toTree();

        return FolderResource::collection($folders);
    }

    public function getRootFolders()
    {
        $rootFolders = $this->authApiUser()->folders()->withDepth()->having('depth', '=', 0)->get();

        return FolderResource::collection($rootFolders);
    }

    public function createRootFolder(Request $request)
    {
        $folder = new Folder();
        $folder->name = $request->name;
        $folder->user_id = $this->authApiUser()->id;

        if ($folder->save()) {
            return new FolderResource($folder);
        }
    }

    public function show(Folder $folder)
    {
        $this->authApiUser()->folders()->findOrFail($folder->id);

        return FolderResource::collection($folder->children);
    }

    public function store(Request $request)
    {
        if (!isset($request->name)) abort(400);

        $parent = $this->authApiUser()->folders()->findOrFail($request->parent_id);

        $folder = new Folder();
        $folder->name = $request->name;
        $folder->user_id = $this->authApiUser()->id;

        if ($folder->appendToNode($parent)->save()) {
            return new FolderResource($folder);
        }
    }

    // THIS UPDATES ONLY FOLDER NAME, AND PARENT_ID
    public function update(Request $request, Folder $folder)
    {
        $this->authApiUser()->folders()->findOrFail($folder->id);

        if (isset($request->name)) $folder->name = $request->name;
        if (isset($request->parent_id)) $folder->parent_id = $request->parent_id;

        if ($folder->save()) {
            return new FolderResource($folder);
        }
    }

    public function destroy(Folder $folder)
    {
        $this->authApiUser()->folders()->findOrFail($folder->id);

        if ($folder->delete()) {
            return new FolderResource($folder);
        }
    }
}
