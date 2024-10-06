<?php

namespace App\Services\v1\admin\product;

use App\Models\Product;
use App\Services\v1\admin\image\StoreImageService;
use Illuminate\Http\JsonResponse;

class StoreProductService
{
    public function execute(array $data): JsonResponse
    {
        $product = Product::create($this->prepareProductData($data));

        StoreIMageService::store($data['images'] ?? [], $product->id, 'Product', 'products');

        $this->syncColors($product, $data['colors'] ?? []);

        return response()->json(['success' => true]);
    }

    private function prepareProductData(array $data): array
    {
        return [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'brand_id' => $data['brand_id'] ?? null,
            'category_id' => $data['category_id'],
        ];
    }

    private function syncColors(Product $product, array $colors): void
    {
        if (!empty($colors)) {
            $syncData = [];

            foreach ($colors as $color) {
                $syncData[$color['id']] = ['quantity' => $color['quantity']];
            }

            $product->colors()->syncWithoutDetaching($syncData);
        }
    }
}
