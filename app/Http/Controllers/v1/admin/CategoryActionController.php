<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreCategoryImageRequest;
use App\Http\Requests\v1\StoreCategoryRequest;
use App\Models\Category;
use App\Services\v1\admin\category\DeleteIconByCategoryService;
use App\Services\v1\admin\category\StoreChildCategoryService;
use App\Services\v1\admin\category\StoreImageByCategoryService;

class CategoryActionController extends Controller
{
    public function addChildren(StoreCategoryRequest $request, Category $category)
    {
        $result = app(StoreChildCategoryService::class)->execute($request->validated(), $category);

        return response()->json([
            'success' => $result
        ]);
    }

    public function addImage(StoreCategoryImageRequest $request, Category $category)
    {
        return app(StoreImageByCategoryService::class)->execute($request->validated(), $category);
    }

    public function deleteImage(Category $category)
    {
        return app(DeleteIconByCategoryService::class)->execute($category);
    }
}
