<?php

namespace App\Services\v1\customer\order;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class StoreOrderService
{
    public function execute(array $data): JsonResponse
    {
        $user = auth()->user();
        $products = $this->loadProducts($data['products']);

        [$dataProduct, $totalPrice] = $this->prepareProductData($data['products'], $products);

        $this->createOrder($user, $data['payment_type_id'] ?? 1, $dataProduct, $totalPrice);

        return response()->json(['success' => true]);
    }

    private function loadProducts(array $productData): Collection
    {
        $productIds = array_column($productData, 'id');
        $colorIds = array_column(array_filter($productData, fn($p) => isset($p['color_id'])), 'color_id');

        return Product::with([
            'media' => function($query) {
                $query->where('is_main', true);
            },
            'colors' => function($query) use ($colorIds) {
                $query->whereIn('id', $colorIds);
            }
        ])->whereIn('id', $productIds)->get();
    }

    private function prepareProductData(array $productData, $products): array
    {
        $dataProduct = [];
        $totalPrice = 0;

        foreach ($products as $product) {
            $colorData = $this->getColorData($product, $productData);
            $price = $this->getProductPrice($product);
            $imageData = $this->getProductImage($product);

            $dataProduct[] = [
                'id' => $product->id,
                'name' => $product->getTranslations('name'),
                'quantity' => $productData[array_search($product->id, array_column($productData, 'id'))]['quantity'],
                'color' => $colorData,
                'price' => $price,
                'image' => $imageData,
            ];

            $totalPrice += $price * $productData[array_search($product->id, array_column($productData, 'id'))]['quantity'];
        }

        return [$dataProduct, $totalPrice];
    }

    private function getColorData($product, $productData): ?array
    {
        $colorData = null;
        $productIndex = array_search($product->id, array_column($productData, 'id'));

        if (isset($productData[$productIndex]['color_id'])) {
            $colorId = $productData[$productIndex]['color_id'];
            $color = $product->colors->firstWhere('id', $colorId);

            if ($color) {
                $colorData = [
                    'id' => $color->id,
                    'name' => $color->getTranslations('name'),
                ];
            }
        }

        return $colorData;
    }

    private function getProductPrice($product)
    {
        return $product->discount_price == 0 ? $product->price : $product->discount_price;
    }

    private function getProductImage($product): ?array
    {
        $mainImage = $product->media->first();

        return $mainImage ? [
            'id' => $mainImage->id,
            'url' => config('app.url') . '/storage/' . $mainImage->path,
        ] : null;
    }

    private function createOrder($user, $paymentTypeId, $dataProduct, $totalPrice): void
    {
        $user->orders()->create([
            'status_id' => 1,
            'payment_type_id' => $paymentTypeId,
            'status_date' => now(),
            'total_price' => $totalPrice,
            'products' => json_encode($dataProduct),
        ]);
    }
}
