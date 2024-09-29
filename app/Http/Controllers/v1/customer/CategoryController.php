<?php

namespace App\Http\Controllers\v1\customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CategoryResource;
use App\Http\Resources\v1\GeneralCollection;
use App\Services\v1\admin\category\IndexCategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = app(IndexCategoryService::class)->execute($request);

        return new GeneralCollection($categories, CategoryResource::class);
    }
}
