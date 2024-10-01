<?php

namespace App\Services\v1\admin\review;

use App\Http\Resources\v1\GeneralCollection;
use App\Http\Resources\v1\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class IndexReviewService
{
    public function execute(Request $request): GeneralCollection
    {
        $reviews = Review::with('user')
            ->when($request->created_at, function ($query) use ($request) {
                $query->whereDate('created_at', $request->created_at);
            })
            ->when($request->created, function ($query) use ($request) {
                $query->orderBy('created_at', $request->created);
            })
            ->paginate($request->per_page ?? 10);

        return new GeneralCollection($reviews, ReviewResource::class);
    }
}
