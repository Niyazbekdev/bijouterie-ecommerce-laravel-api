<?php

namespace App\Services\v1\admin\brand;

use App\Http\Resources\v1\NameResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexBrandService
{
    public function execute(Request $request): AnonymousResourceCollection
    {
        $brands = Brand::select('id', 'name')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get();

        return NameResource::collection($brands);
    }
}
