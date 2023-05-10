<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'about' => $this->about,
            'photos' => ImageResource::collection($this->images),
            'floors' => FloorResource::collection($this->floors),
            'panoramas' => PanoramaResource::collection($this->panoramas),
            'features' => FeatureResource::collection($this->features),
            'details' => DetailResource::collection($this->details),
        ];
    }
}
