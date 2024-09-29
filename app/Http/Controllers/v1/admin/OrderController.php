<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GeneralCollection;
use App\Http\Resources\v1\OrderResource;
use App\Services\v1\admin\order\IndexOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = app(IndexOrderService::class)->execute($request);

        return new GeneralCollection($orders, OrderResource::class);
    }
}
