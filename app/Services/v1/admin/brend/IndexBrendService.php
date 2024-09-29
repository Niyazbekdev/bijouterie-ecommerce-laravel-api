<?php

namespace App\Services\v1\admin\brend;

use App\Http\Resources\v1\NameResource;
use App\Models\Brend;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexBrendService
{
    public function execute(Request $request): AnonymousResourceCollection
    {
        $brends = Brend::select('id', 'name')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get();

        return NameResource::collection($brends);
    }
}
