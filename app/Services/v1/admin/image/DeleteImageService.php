<?php

namespace App\Services\v1\admin\image;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class DeleteImageService
{
    public function execute(object $model, int|string $imageId): JsonResponse
    {
        $media = $model->media()->findOrFail($imageId);

        Storage::disk('public')->delete($media->path);
        $media->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
