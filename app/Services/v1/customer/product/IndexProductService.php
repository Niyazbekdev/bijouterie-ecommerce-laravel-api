<?php

namespace App\Services\v1\customer\product;

use App\Http\Requests\v1\FilterProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexProductService
{
    public function execute(FilterProductRequest $request): LengthAwarePaginator
    {
        $searchTerm = mb_strtolower($request->search, 'UTF-8');

        $categoryIds = [];

        if ($request->has('category')) {
            $category = Category::findOrFail($request->category);

            if ($category->children()->exists()) {
                $categoryIds = $category->children()->pluck('id')->toArray();
            }
            $categoryIds[] = $category->id;
        }

        return Product::with(['media'])
            ->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(JSON_EXTRACT(name, "$.kaa")) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(name, "$.ru")) LIKE ?', ["%{$searchTerm}%"]);
            })
            ->when(!empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->when($request->filled('price'), function ($query) use ($request) {
                $query->orderBy('price', $request->price);
            })
            ->when($request->filled('created_at'), function ($query) use ($request) {
                $query->orderBy('created_at', $request->created_at);
            })
            ->when($request->filled('sold'), function ($query) use ($request) {
                $query->orderBy('sold', $request->sold);
            })
            ->when($request->filled('from_price') && $request->filled('to_price'), function ($query) use ($request) {
                $query->whereBetween('price', [$request->from_price, $request->to_price]);
            })
            ->when($request->filled('colors'), function ($query) use ($request) {
                $query->whereHas('colors', function ($query) use ($request) {
                    $query->whereIn('id', $request->colors);
                });
            })
            ->when($request->filled('brands'), function ($query) use ($request) {
                $query->whereIn('brand_id', $request->brands);
            })
            ->paginate($request->get('per_page', 10));
    }
}
