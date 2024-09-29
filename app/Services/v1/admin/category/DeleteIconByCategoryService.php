<?php

namespace App\Services\v1\admin\category;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class DeleteIconByCategoryService
{
    public function execute(object $category): JsonResponse
    {
        Storage::disk('public')->delete('icons/' . $category->icon);
        $category->update([
            'icon' => null
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
