<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'height' => $this->height * 100,
            'weight' => $this->weight / 1000,
            'types' => empty($this->types) ? null : TypeResource::collection($this->types),
        ];
    }
}
