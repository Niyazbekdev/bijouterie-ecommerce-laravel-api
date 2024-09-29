<?php

use App\Http\Controllers\v1\customer\CartController;
use App\Http\Controllers\v1\customer\CategoryController;
use App\Http\Controllers\v1\customer\FavoriteController;
use App\Http\Controllers\v1\customer\LoginController;
use App\Http\Controllers\v1\customer\OrderController;
use App\Http\Controllers\v1\customer\ProductController;
use App\Http\Controllers\v1\customer\ReviewController;
use App\Http\Controllers\v1\ProfileController;
use Illuminate\Support\Facades\Route;

include 'admin.php';

Route::post('customer/login', LoginController::class);

Route::prefix('customer')->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);
    Route::get('products/{product}/reviews', [ReviewController::class, 'index']);
});

Route::prefix('customer')
    ->middleware(['auth:sanctum', 'ability:customer'])
    ->group(function () {
        Route::get('/getMe', [ProfileController::class, 'getProfile']);
        Route::post('/logout', [ProfileController::class, 'logout']);

        Route::apiResource('favorites', FavoriteController::class)->except(['show', 'update']);
        Route::apiResource('carts', CartController::class)->except(['show', 'update']);

        Route::get('orders', [OrderController::class, 'index']);
        Route::post('orders', [OrderController::class, 'store']);

        Route::post('products/{product}/reviews', [ReviewController::class, 'store']);
        Route::get('products/{product}/reviews/{id}', [ReviewController::class, 'show']);
    });
