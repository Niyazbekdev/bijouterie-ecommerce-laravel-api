<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get the first color with the pivot data
        $color = $this->colors->first(); // Or you can apply other logic to select specific color

        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'price' => $this->price,
            'discount' => $this->discount,
            'quantity' => $this->quantity,
            'color' => $color ? new ColorResource($color) : null,
            'image' => new MediaResource($this->media->where('is_main', 1)->first()),
        ];
    }
}
