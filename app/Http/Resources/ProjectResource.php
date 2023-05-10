<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sub_name' => $this->sub_name,
            'about' => $this->about,
            'file' => $this->file,
            'main_photo' => $this->main_image,
            'second_photo' => $this->second_image,
            'photos' => ImageResource::collection($this->images),
            'details' => AspectResource::collection($this->aspects),
            'features' => FeatureResource::collection($this->features),
            'benefits' => BenefitResource::collection($this->benefits),
            'apartments' => ApartmentResource::collection($this->apartments),
        ];
    }
}
