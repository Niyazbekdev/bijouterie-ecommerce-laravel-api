<?php

namespace App\Http\Controllers\v1\customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductResource;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $products =  auth()->user()->favorites()->get();

        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        auth()->user()->favorites()->attach($request->product_id);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy($favorite_id)
    {
        if(auth()->user()->favorites()->where('product_id', $favorite_id)->exists()){
            auth()->user()->favorites()->detach($favorite_id);
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
