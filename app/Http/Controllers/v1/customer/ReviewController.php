<?php

namespace App\Http\Controllers\v1\customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreReviewRequest;
use App\Http\Resources\v1\GeneralCollection;
use App\Http\Resources\v1\ReviewResource;
use App\Models\Product;
use App\Services\v1\customer\review\StoreReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Product $product, Request $request)
    {
        $reviews = $product->reviews()
            ->with('user')
            ->paginate($request->per_page ?? 10);

        return new GeneralCollection($reviews, ReviewResource::class);
    }

    public function store(StoreReviewRequest $request, Product $product)
    {
        return app(StoreReviewService::class)->execute($request->validated(), $product);
    }

    public function show(Product $product, string $review)
    {
        $reviews = $product->reviews()->findOrFail($review);
        return new ReviewResource($reviews);
    }
}
