<?php

namespace App\Http\Resources;

use App\Models\Panorama;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray($request)
    {
        $panorama = Panorama::find($this->to_panorama_id);

        return [
            'id' => $this->id,
            'coordinates' => $this->coordinates,
            'panorama' => [
                'id' => $panorama->id,
                'name' => $panorama->name,
                'photo' => $panorama->photo,
            ]
        ];
    }
}
