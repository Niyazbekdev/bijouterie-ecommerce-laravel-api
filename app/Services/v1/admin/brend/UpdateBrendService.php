<?php

namespace App\Services\v1\admin\brend;

use Illuminate\Http\JsonResponse;

class UpdateBrendService
{
    public function execute(array $data, object $brend): JsonResponse
    {
        $brend->update([
            'name' => $data['name'],
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
