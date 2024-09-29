<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => new TranslateNameResource($this->whenLoaded('category')),
            'brend' => new NameResource($this->whenLoaded('brend')),
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'quantity' => $this->quantity,
            'description' => $this->getTranslations('description'),
            'sold' => $this->sold,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'discount' => new DiscountResource($this->whenLoaded('discount')),
            'images' => MediaResource::collection($this->whenLoaded('media')),
            'colors' => ColorResource::collection($this->whenLoaded('colors')),
        ];
    }
}
