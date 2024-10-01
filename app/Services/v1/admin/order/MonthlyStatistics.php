<?php

namespace App\Services\v1\admin\order;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class MonthlyStatistics extends OrderStats
{
    /**
     * @throws \Exception
     */
    public function getStatistics($statusId, $year): JsonResponse
    {
        try {
            $startDate = Carbon::createFromFormat('Y', $year)->startOfYear()->format('Y-m-d 00:00:00');
            $endDate = Carbon::createFromFormat('Y', $year)->endOfYear()->format('Y-m-d 23:59:59');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid year format. Use YYYY.'], 400);
        }

        $query = $this->getOrderQuery('month', $startDate, $endDate, $statusId);
        $orders = $query->groupBy('month')->get();

        $ordersByMonthsPrice = [];
        $ordersByMonthsCount = [];

        // Initialize each month with 0 values
        for ($i = 1; $i <= 12; $i++) {
            $ordersByMonthsPrice[$i] = [
                'month' => $i,
                'total_price' => 0,
            ];
            $ordersByMonthsCount[$i] = [
                'month' => $i,
                'order_count' => 0,
            ];
        }

        // Assign the actual data to each month
        foreach ($orders as $order) {
            $month = (int) $order->month; // Ensure $month is an integer
            if (isset($ordersByMonthsPrice[$month])) {
                $ordersByMonthsPrice[$month]['total_price'] = $order->total_price;
            }
            if (isset($ordersByMonthsCount[$month])) {
                $ordersByMonthsCount[$month]['order_count'] = $order->order_count;
            }
        }

        return response()->json([
            'message' => 'ОК',
            'data' => [
                'orders_by_months_price' => array_values($ordersByMonthsPrice),
                'orders_by_months_count' => array_values($ordersByMonthsCount),
            ],
        ]);
    }
}
