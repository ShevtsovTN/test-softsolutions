<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'rent' => $this->rent,
            'year' => $this->year,
            'register_number' => $this->register_number,
            'color' => $this->color,
            'kpp' => $this->kpp,
            'model' => BrandResource::make($this->whenLoaded('model')),
            'foto' => FileResource::make($this->whenLoaded('foto')),
            'created_at' => $this->created_at,
            'updated_at' => $this->created_at,
        ];
    }
}
