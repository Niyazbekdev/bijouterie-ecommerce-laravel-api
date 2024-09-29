<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreImageRequest;
use App\Models\Product;
use App\Services\v1\admin\image\DeleteImageService;
use App\Services\v1\admin\product\StoreProductImageService;

class ProductImageController extends Controller
{
    public function store(StoreImageRequest $request, Product $product)
    {
        return app(StoreProductImageService::class)->execute($request->validated(), $product);
    }

    public function update(Product $product, string $image)
    {
        $media = $product->media()->findOrFail($image);

        $media->update([
            'is_main' => true,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Product $product, string $image)
    {
        return app(DeleteImageService::class)->execute($product, $image);
    }
}
