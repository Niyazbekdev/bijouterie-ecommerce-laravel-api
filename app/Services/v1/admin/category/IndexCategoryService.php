<?php

namespace App\Services\v1\admin\category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IndexCategoryService
{
    public function execute(Request $request)
    {
        $searchTerm = mb_strtolower($request->search, 'UTF-8');

        return Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->where(function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->whereRaw('LOWER(JSON_EXTRACT(name, "$.kaa")) LIKE ?', ["%{$searchTerm}%"])
                        ->orWhereRaw('LOWER(JSON_EXTRACT(name, "$.ru")) LIKE ?', ["%{$searchTerm}%"]);
                })
                    ->orWhereHas('childrenRecursive', function (Builder $builder) use ($searchTerm) {
                        $builder->where(function ($query) use ($searchTerm) {
                            $query->whereRaw('LOWER(JSON_EXTRACT(name, "$.kaa")) LIKE ?', ["%{$searchTerm}%"])
                                ->orWhereRaw('LOWER(JSON_EXTRACT(name, "$.ru")) LIKE ?', ["%{$searchTerm}%"]);
                        });
                    });
            })
            ->paginate($request->per_page ?? 10);
    }
}
