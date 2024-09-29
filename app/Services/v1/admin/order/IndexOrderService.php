<?php

namespace App\Services\v1\admin\order;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class IndexOrderService
{
    public function execute(Request $request): LengthAwarePaginator
    {
        return Order::with(['user', 'status', 'paymentType'])
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status_id', $request->status);
            })
            ->when($request->payment, function ($query) use ($request) {
                return $query->where('payment_type_id', $request->payment);
            })
            ->when($request->created_at, function ($query) use ($request) {
                return $query->whereDate('created_at', $request->created_at);
            })
            ->paginate($request->per_page ?? 10);
    }
}
