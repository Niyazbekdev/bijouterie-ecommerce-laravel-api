<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreProductRequest;
use App\Http\Requests\v1\UpdateProductRequest;
use App\Http\Resources\v1\GeneralCollection;
use App\Http\Resources\v1\ProductResource;
use App\Models\Product;
use App\Services\v1\admin\product\DeleteProductService;
use App\Services\v1\admin\product\IndexProductService;
use App\Services\v1\admin\product\StoreProductService;
use App\Services\v1\admin\product\UpdateProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = app(IndexProductService::class)->execute($request);

        return new GeneralCollection($products, ProductResource::class);
    }

    public function store(StoreProductRequest $request)
    {
        return app(StoreProductService::class)->execute($request->validated());
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load('colors', 'media', 'discount'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return app(UpdateProductService::class)->execute($request->validated(), $product);
    }

    public function destroy(Product $product)
    {
        return app(DeleteProductService::class)->execute($product);
    }
}
