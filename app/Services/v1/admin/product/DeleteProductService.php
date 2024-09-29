<?php

namespace App\Services\v1\admin\product;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class DeleteProductService
{
    public function execute(object $product): JsonResponse
    {
        $mediaToDelete = $product->media()->get();

        if ($mediaToDelete->isNotEmpty()) {
            foreach ($mediaToDelete as $media) {
                Storage::disk('public')->delete($media->path);
            }

            $mediaToDeleteIds = $mediaToDelete->pluck('id')->toArray();

            $product->media()->whereIn('id', $mediaToDeleteIds)->delete();
        }

        $product->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
