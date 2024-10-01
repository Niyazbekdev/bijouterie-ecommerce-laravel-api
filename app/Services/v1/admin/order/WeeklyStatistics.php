<?php

namespace App\Services\v1\admin\order;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class WeeklyStatistics extends OrderStats
{
    public function getStatistics($statusId, $weekParam = null): JsonResponse
    {
        try {
            if ($weekParam) {
                [$year, $week] = explode('-', $weekParam);
                $weekYear = Carbon::create($year, 1, 1)->setISODate($year, $week);
            } else {
                $weekYear = Carbon::now();
            }
            $startDate = $weekYear->startOfWeek()->format('Y-m-d 00:00:00');
            $endDate = $weekYear->endOfWeek()->format('Y-m-d 23:59:59');

            // Har bir kun uchun statistikani olish
            $query = $this->getOrderQuery('day', $startDate, $endDate, $statusId);
            $orders = $query->groupBy('day')->get();

            $ordersByDays = [];

            // Haftaning har bir kuni uchun statistikani tayyorlash
            for ($day = 0; $day < 7; $day++) {
                $currentDate = Carbon::parse($startDate)->addDays($day)->format('Y-m-d');
                $ordersByDays[$currentDate] = [
                    'day' => Carbon::parse($currentDate)->format('l'), // Kunning nomi (Dushanba, Seshanba...)
                    'date' => $currentDate,
                    'total_price' => 0,
                    'order_count' => 0,
                ];
            }

            // Har bir kunga mos keladigan statistikani kiritish
            foreach ($orders as $order) {
                $day = Carbon::createFromFormat('d', $order->day)->format('Y-m-d');
                if (isset($ordersByDays[$day])) {
                    $ordersByDays[$day]['total_price'] = $order->total_price;
                    $ordersByDays[$day]['order_count'] = $order->order_count;
                }
            }

            return response()->json([
                'message' => 'ОК',
                'data' => [
                    'orders_by_days' => array_values($ordersByDays),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid week format. Use YYYY-WW.'], 400);
        }
    }
}
