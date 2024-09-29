<?php

namespace App\Services\v1\admin\color;

use App\Models\Color;
use Illuminate\Http\JsonResponse;

class StoreColorService
{
    public function execute(array $data): JsonResponse
    {
        Color::create([
            'name' => $data['name'],
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
