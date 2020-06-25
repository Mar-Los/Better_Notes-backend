<?php

namespace App\Http\Controllers\Api;

use App\DictionaryFileContent;
use App\Http\Controllers\Controller;
use App\Http\Resources\DictionaryFileContent as DictionaryFileContentResource;
use Illuminate\Http\Request;

class DictionaryFileController extends Controller
{
    public function findDictionaryFile($fileId)
    {
        $file = $this->authApiUser()->files()->findOrFail($fileId);

        if ($file->fileable_type != 'App\DictionaryFile') abort(404);

        return $file->fileable;
    }

    public function store(Request $request, $fileId)
    {
        if (!isset($request->key) || !isset($request->value)) abort(400);

        $dictionaryFile = $this->findDictionaryFile($fileId);

        $row = new DictionaryFileContent();
        $row->dictionary_file_id = $dictionaryFile->id;
        $row->column_key = $request->key;
        $row->column_value = $request->value;

        if ($row->save()) {
            return new DictionaryFileContentResource($row);
        }
    }

    // Structure of request:    
    // key: column_key
    // value: column_value
    public function update(Request $request, $fileId, $rowId)
    {
        $row = $this->findDictionaryFile($fileId)->rows()->findOrFail($rowId);

        if (isset($request->key)) $row->column_key = $request->key;
        if (isset($request->value)) $row->column_value = $request->value;

        if ($row->save()) {
            return new DictionaryFileContentResource($row);
        }
    }

    public function destroy($fileId, $rowId)
    {
        $row = $this->findDictionaryFile($fileId)->rows()->findOrFail($rowId);

        if ($row->delete()) {
            return new DictionaryFileContentResource($row);
        }
    }
}
