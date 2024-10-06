<?php

namespace App\Services\v1\admin\brand;

use Illuminate\Http\JsonResponse;

class UpdateBrandService
{
    public function execute(array $data, object $brand): JsonResponse
    {
        $brand->update([
            'name' => $data['name'],
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
