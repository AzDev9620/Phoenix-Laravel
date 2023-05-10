<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PanoramaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $this->photo,
            'links' => LinkResource::collection($this->links),
        ];
    }
}
