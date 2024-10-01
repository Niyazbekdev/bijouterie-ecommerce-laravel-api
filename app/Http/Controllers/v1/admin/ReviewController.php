<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreAnswerRequest;
use App\Models\Review;
use App\Services\v1\admin\review\IndexReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        return app(IndexReviewService::class)->execute($request);
    }

    public function update(StoreAnswerRequest $request, Review $review)
    {
        $answer = [
            'answer' => $request->answer,
            'date' => now(),
        ];

        $review->update([
            'answers' => json_encode($answer),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
