<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TextFile as TextFileResource;
use Illuminate\Http\Request;

class TextFileController extends Controller
{
    // Only update needed - when file with type text created,
    // creates related textfile row with content=''.
    //When file with type text deleted - deletes the textfile row.


    // The $id is meant to be the file id (not the id of textfile)
    public function update(Request $request, $id)
    {
        $file = $this->authApiUser()->files()->findOrFail($id);

        if ($file->fileable_type != 'App\TextFile') abort(404);

        $textFile = $file->fileable;

        if (isset($request->content)) $textFile->content = $request->content;

        if ($textFile->save()) {
            return new TextFileResource($textFile);
        }
    }
}
