<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreCategoryRequest;
use App\Http\Requests\v1\UpdateCategoryRequest;
use App\Http\Resources\v1\CategoryResource;
use App\Http\Resources\v1\GeneralCollection;
use App\Models\Category;
use App\Services\v1\admin\category\DeleteCategoryService;
use App\Services\v1\admin\category\IndexCategoryService;
use App\Services\v1\admin\category\StoreCategoryService;
use App\Services\v1\admin\category\UpdateCategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = app(IndexCategoryService::class)->execute($request);
        return new GeneralCollection($categories, CategoryResource::class);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = app(StoreCategoryService::class)->execute($request->validated());

        return response()->json([
            'success' => $category
        ]);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $result = app(UpdateCategoryService::class)->execute($request->validated(), $category);

        return response()->json([
            'success' => $result
        ]);
    }

    public function destroy(Category $category)
    {
        return app(DeleteCategoryService::class)->execute($category);
    }
}
