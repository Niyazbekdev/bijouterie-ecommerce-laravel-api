<?php

namespace App\Services\v1\admin\product;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class IndexProductService
{
    public function execute(Request $request): LengthAwarePaginator
    {
        $searchTerm = mb_strtolower($request->search, 'UTF-8');

        return Product::with(['category', 'brend', 'media'])
            ->where(function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->whereRaw('LOWER(JSON_EXTRACT(name, "$.kaa")) LIKE ?', ["%{$searchTerm}%"])
                        ->orWhereRaw('LOWER(JSON_EXTRACT(name, "$.ru")) LIKE ?', ["%{$searchTerm}%"]);
                });
            })
            ->when($request->brand, function ($query) use ($request) {
                $query->where('brand_id', $request->brand);
            })
            ->when($request->price, function ($query) use ($request) {
                $query->orderBy('price', $request->price);
            })
            ->when($request->quantity, function ($query) use ($request) {
                $query->orderBy('quantity', $request->quantity);
            })
            ->when($request->sold, function ($query) use ($request) {
                $query->orderBy('sold', $request->sold);
            })
            ->when($request->created_at, function ($query) use ($request) {
                $query->orderBy('created_at', $request->created_at);
            })
            ->paginate($request->per_page ?? 10);
    }
}
