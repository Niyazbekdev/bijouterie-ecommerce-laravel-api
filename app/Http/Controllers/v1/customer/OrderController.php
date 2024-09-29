<?php

namespace App\Http\Controllers\v1\customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreOrderRequest;
use App\Http\Resources\v1\GeneralCollection;
use App\Http\Resources\v1\OrderResource;
use App\Services\v1\customer\order\StoreOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $orders = $user->orders()
            ->with('status', 'paymentType')
            ->orderBy('created_at', 'desc')
            ->when($request->status, function ($query, $status) {
                $query->where('status_id', $status);
            })
            ->get();

        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        return app(StoreOrderService::class)->execute($request->validated());
    }
}
