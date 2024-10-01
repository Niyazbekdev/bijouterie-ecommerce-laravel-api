<?php

namespace App\Services\v1\admin\order;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class YearlyStatistics extends OrderStats
{
    public function getStatistics($statusId, $yearParam = null): JsonResponse
    {
        try {
            if ($yearParam) {
                $startDate = Carbon::create($yearParam, 1, 1)->startOfYear()->format('Y-m-d 00:00:00');
                $endDate = Carbon::create($yearParam, 12, 31)->endOfYear()->format('Y-m-d 23:59:59');
            } else {
                $currentYear = Carbon::now();
                $startDate = $currentYear->startOfYear()->format('Y-m-d 00:00:00');
                $endDate = $currentYear->endOfYear()->format('Y-m-d 23:59:59');
            }

            $query = $this->getOrderQuery('year', $startDate, $endDate, $statusId);
            $orders = $query->groupBy('year')->get();

            $year = Carbon::parse($startDate)->year;

            $ordersByYears = [
                $year => [
                    'year' => $year,
                    'total_price' => 0,
                    'order_count' => 0,
                ],
            ];

            foreach ($orders as $order) {
                $ordersByYears[$year]['total_price'] = $order->total_price;
                $ordersByYears[$year]['order_count'] = $order->order_count;
            }

            return response()->json([
                'message' => 'ОК',
                'data' => [
                    'orders_by_year' => array_values($ordersByYears),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid year format. Use YYYY.'], 400);
        }
    }
}
