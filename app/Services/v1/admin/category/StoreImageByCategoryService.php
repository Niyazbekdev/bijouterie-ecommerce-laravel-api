<?php

namespace App\Services\v1\admin\category;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class StoreImageByCategoryService
{
    public function execute(array $data, object $category): JsonResponse
    {
        $icon = $data["icon"]->hashName();

        if ($category->icon) {
            Storage::disk('public')->delete('icons/' . $category->icon);
        }

        $data['icon']->store('icons', 'public');

        $category->update([
            'icon' => $icon
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
