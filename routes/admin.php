<?php

use App\Http\Controllers\v1\admin\BrandController;
use App\Http\Controllers\v1\admin\CategoryController;
use App\Http\Controllers\v1\admin\CategoryActionController;
use App\Http\Controllers\v1\admin\ColorController;
use App\Http\Controllers\v1\admin\DiscountController;
use App\Http\Controllers\v1\admin\OrderController;
use App\Http\Controllers\v1\admin\ProductController;
use App\Http\Controllers\v1\admin\ProductImageController;
use App\Http\Controllers\v1\admin\ReviewController;
use App\Http\Controllers\v1\admin\StatisticController;
use App\Http\Controllers\v1\ProfileController;
use App\Http\Controllers\v1\admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', LoginController::class);

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'ability:admin'])
    ->group(function () {
        Route::get('/getMe', [ProfileController::class, 'getProfile']);
        Route::post('/logout', [ProfileController::class, 'logout']);

        Route::apiResource('categories', CategoryController::class);
        Route::post('categories/{category}/children', [CategoryActionController::class, 'addChildren']);
        Route::post('categories/{category}/image', [CategoryActionController::class, 'addImage']);
        Route::delete('categories/{category}/image', [CategoryActionController::class, 'deleteImage']);

        Route::apiResource('brands', BrandController::class);
        Route::apiResource('products', ProductController::class);
        Route::apiResource('colors', ColorController::class);

        Route::apiResource('products/{product}/images', ProductImageController::class)->except('index', 'show');
        Route::apiResource('products/{product}/discounts', DiscountController::class)->only('store', 'destroy');

        Route::get('orders', [OrderController::class, 'index']);

        Route::get('reviews', [ReviewController::class, 'index']);
        Route::put('reviews/{review}', [ReviewController::class, 'update']);

        Route::get('orders/statistics/day', [StatisticController::class, 'getDay']);
        Route::get('orders/statistics/week', [StatisticController::class, 'getWeek']);
        Route::get('orders/statistics/month', [StatisticController::class, 'getMonth']);
        Route::get('orders/statistics/year', [StatisticController::class, 'getYear']);
});
