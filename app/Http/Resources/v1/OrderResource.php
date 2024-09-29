<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user' => new NameResource($this->whenLoaded('user')),
            'status' => new TranslateNameResource($this->whenLoaded('status')),
            'status_date' => $this->status_date,
            'payment_type' => new NameResource($this->whenLoaded('paymentType')),
            'total_price' => $this->total_price,
            'products' => json_decode($this->products)
        ];
    }
}
