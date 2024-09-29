<?php

namespace App\Services\v1\admin\discount;

use App\Models\Discount;
use Illuminate\Http\JsonResponse;

class StoreDiscountService
{
    public function execute(object $product, array $data): JsonResponse
    {
        Discount::firstOrCreate([
            'product_id' => $product->id,
        ], [
            'name' => $data['name'] ?? null,
            'percent' => $data['percent'] ?? null,
            'sum' => $data['sum'] ?? null,
            'from_date' => $data['from_date'] ?? null,
            'to_date' => $data['to_date'] ?? null,
        ]);

        $discountPrice = 0;

        if ($data['sum']) {
            $discountPrice = $product->price - $data['sum'];
        } else if ($data['percent']) {
            $discountPrice = round($product->price * ((100 - $data['percent']) / 100));
        }

        $product->update(['discount_price' => $discountPrice]);

        return response()->json([
            'success' => true,
        ]);
    }
}
