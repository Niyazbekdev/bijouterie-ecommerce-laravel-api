<?php

namespace App\Services\v1\admin\image;

use App\Models\Media;

class StoreImageService
{
    public static function store(array $images, int $modelId, string $modelType, string $collection = 'default'): void
    {
        if (empty($images)) {
            return;
        }

        $class = 'App\\Models\\' . $modelType;

        $dataFile = [];
        foreach ($images as $image) {
            $fileName = $image->hashName();
            $image->store($collection, 'public');

            $dataFile[] = [
                'model_id' => $modelId,
                'model_type' => $class,
                'collection_name' => $collection,
                'path' => $collection . '/' . $fileName,
                'file_name' => $fileName,
                'is_main' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Media::insert($dataFile);
    }
}
