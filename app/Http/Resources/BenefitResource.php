<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BenefitResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'icon' => $this->icon,
            'name' => $this->name,
            'number' => $this->number
        ];
    }
}
