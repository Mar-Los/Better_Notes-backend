<?php

namespace App\Http\Resources;



use Illuminate\Http\Resources\Json\JsonResource;

class Folder extends JsonResource
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
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'children' => Folder::collection($this->whenLoaded('children')),
        ];
    }
}
