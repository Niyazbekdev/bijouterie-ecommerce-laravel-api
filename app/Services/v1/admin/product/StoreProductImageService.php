<?php

namespace App\Services\v1\admin\product;

use App\Services\v1\admin\image\StoreImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class StoreProductImageService
{
    public function execute(array $data, object $product): JsonResponse
    {
        $count = 5;
        $requestImages = $data['images'] ?? [];
        if (count($data['images']) > $count) {
            throw ValidationException::withMessages([
                'count' => "The maximum number of files is {$count}",
            ]);
        }

        $existingMedia = $product->media()->get();

        $imagesToKeepCount = max(0, $count - count($requestImages));
        $toKeep = $existingMedia->slice(-$imagesToKeepCount)->pluck('id')->toArray();

        $mediaToDelete = $existingMedia->reject(function ($media) use ($toKeep) {
            return in_array($media->id, $toKeep);
        });

        foreach ($mediaToDelete as $media) {
            Storage::delete('public/' . $media->path);
        }

        $mediaToDeleteIds = $mediaToDelete->pluck('id')->toArray();
        $product->media()->whereIn('id', $mediaToDeleteIds)->delete();

        StoreIMageService::store($data['images'] ?? [], $product->id, 'Product', 'products');

        return response()->json([
            'success' => true,
        ]);
    }
}
