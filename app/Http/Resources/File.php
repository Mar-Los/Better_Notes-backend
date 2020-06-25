<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;


use App\Http\Resources\TextFile as TextFileResource;
use App\Http\Resources\DictionaryFile as DictionaryFileResource;

class File extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'folder_id' => $this->folder_id,
            'name' => $this->name,
            'type' => Str::of($this->fileable_type)->after('App\\')->before('File')->lower()->__toString(),
            'content' => $this->when($this->relationLoaded('fileable'), function () {
                switch (true) {
                    case $this->fileable instanceof \App\TextFile:
                        return $this->fileable->content;
                    case $this->fileable instanceof \App\DictionaryFile:
                        return new DictionaryFileResource($this->fileable);
                }
            }),
        ];
    }
}
