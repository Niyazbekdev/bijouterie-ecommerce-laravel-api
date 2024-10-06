<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreBrandRequest;
use App\Http\Resources\v1\NameResource;
use App\Models\Brand;
use App\Services\v1\admin\brand\IndexBrandService;
use App\Services\v1\admin\brand\StoreBrandService;
use App\Services\v1\admin\brand\UpdateBrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        return app(IndexBrandService::class)->execute($request);
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = app(StoreBrandService::class)->execute($request->validated());

        return response()->json([
            'success' => $brand,
        ]);
    }

    public function show(Brand $brand)
    {
        return new NameResource($brand);
    }

    public function update(StoreBrandRequest $request, Brand $brand)
    {
        return app(UpdateBrandService::class)->execute($request->validated(), $brand);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
