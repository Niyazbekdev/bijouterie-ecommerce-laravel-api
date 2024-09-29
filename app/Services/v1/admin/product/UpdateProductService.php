<?php

namespace App\Services\v1\admin\product;

use App\Services\v1\functions\UpdateData;
use Illuminate\Http\JsonResponse;

class UpdateProductService
{
    public function execute(array $data, object $product): JsonResponse
    {
        $updateData = UpdateData::execute($data);

        if (! empty($updateData)) {
            $product->update($updateData);
        }

        $colors = $data['colors'] ?? [];

        if (! empty($colors)) {
            $syncData = [];

            foreach ($colors as $color) {
                $syncData[$color['id']] = ['quantity' => $color['quantity']];
            }

            $product->colors()->syncWithoutDetaching($syncData);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
