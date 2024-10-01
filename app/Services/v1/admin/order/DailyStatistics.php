<?php

namespace App\Services\v1\admin\order;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DailyStatistics extends OrderStats
{
    /**
     * @throws \Exception
     */
    public function getStatistics($statusId, $dateRange): JsonResponse
    {
        $month = Carbon::parse($dateRange)->format('Y-m');
        $startDate = Carbon::parse($month.'-01')->startOfMonth()->format('Y-m-d 00:00:00');
        $endDate = Carbon::parse($month.'-01')->endOfMonth()->format('Y-m-d 23:59:59');

        $totalDaysInMonth = Carbon::parse($month.'-01')->daysInMonth;

        $query = $this->getOrderQuery('day', $startDate, $endDate, $statusId);
        $orders = $query->groupBy('day')->get();

        $ordersByDaysPrice = [];
        $ordersByDaysCount = [];

        for ($day = 1; $day <= $totalDaysInMonth; $day++) {
            $ordersByDaysPrice[] = [
                'day' => $day,
                'total_price' => $orders->where('day', $day)->sum('total_price'),
            ];
            $ordersByDaysCount[] = [
                'day' => $day,
                'order_count' => $orders->where('day', $day)->count(),
            ];
        }

        return response()->json([
            'message' => 'ОК',
            'data' => [
                'orders_by_days_price' => $ordersByDaysPrice,
                'orders_by_days_count' => $ordersByDaysCount,
            ],
        ]);
    }
}
