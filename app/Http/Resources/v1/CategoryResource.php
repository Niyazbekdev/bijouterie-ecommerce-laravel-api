<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->getTranslations('name'),
            'icon' => $this->iconUrl,
            'parent_id' => $this->parent_id,
            'children' => CategoryResource::collection($this->whenLoaded('childrenRecursive')),
        ];
    }
}
