<?php

namespace App\Services\v1\customer\review;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreReviewService
{
    public function execute(array $data, Product $product): JsonResponse
    {
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)
            ->where('status_id', 3)
            ->get();

        $productIds = $orders->flatMap(function ($order) {
            return collect(json_decode($order->products))->pluck('id');
        })->toArray();

        if (!in_array($product['id'], $productIds)) {
            throw ValidationException::withMessages([
                'error' => 'You must have purchased this product to write a review',
            ]);
        }

        $product->reviews()->firstOrCreate([
            'user_id' => $userId,
        ], [
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
            'is_anonym' => $data['is_anonym'],
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
