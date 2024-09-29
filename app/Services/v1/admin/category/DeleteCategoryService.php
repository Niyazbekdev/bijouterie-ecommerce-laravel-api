<?php

namespace App\Services\v1\admin\category;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class DeleteCategoryService
{
    public function execute(object $category): JsonResponse
    {
        if ($category->children()->exists()) {
            return response()->json([
                'error' => 'Category cannot be deleted because it has child categories.'
            ], 422);
        }

        $icon = $category->icon;

        if ($icon != null) {
            Storage::disk('public')->delete('icons/' . $icon);
        }

        $category->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
