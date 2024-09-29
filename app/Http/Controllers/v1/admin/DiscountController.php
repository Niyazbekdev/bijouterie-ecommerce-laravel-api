<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreDiscountRequest;
use App\Models\Product;
use App\Services\v1\admin\discount\StoreDiscountService;

class DiscountController extends Controller
{
    public function store(StoreDiscountRequest $request, Product $product)
    {
        return app(StoreDiscountService::class)->execute($product, $request->validated());
    }

    public function destroy(Product $product)
    {
        $product->discount()->delete();

        $product->update(['discount_price' => 0]);

        return response()->json([
            'success' => true,
        ]);
    }
}
