<?php

namespace App\Http\Controllers\v1\customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CartResource;
use App\Http\Resources\v1\ProductResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $product = auth()->user()->carts()->with('media')->get();

        return CartResource::collection($product);
    }

    public function store(Request $request)
    {
        auth()->user()->carts()->attach($request->product_id, ['color_id' => $request->color_id ?? null]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy($cart_id)
    {
        if (auth()->user()->carts()->where('product_id', $cart_id)->exists()) {
            auth()->user()->carts()->detach($cart_id);
            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Favorite does not exist in this user'
        ]);
    }
}
