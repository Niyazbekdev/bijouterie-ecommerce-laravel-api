<?php

namespace App\Http\Controllers\v1\customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\FilterProductRequest;
use App\Http\Requests\v1\StoreProductRequest;
use App\Http\Resources\v1\GeneralCollection;
use App\Http\Resources\v1\ProductResource;
use App\Models\Product;
use App\Services\v1\customer\product\IndexProductService;

class ProductController extends Controller
{
    public function index(FilterProductRequest $request)
    {
        $products = app(IndexProductService::class)->execute($request);

        return new GeneralCollection($products, ProductResource::class);
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load('media'));
    }
}
