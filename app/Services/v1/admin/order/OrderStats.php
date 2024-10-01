<?php

namespace App\Services\v1\admin\order;

use App\Http\Requests\v1\FilterOrderStatsRequest;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderStats
{
    /**
     * @throws \Exception
     */
    public function execute(FilterOrderStatsRequest $request, $dateRange): JsonResponse
    {
        $statusId = $request->input('status_id') ?? 2;
        $month = $request->input('month', Carbon::now()->format('Y-m'));
        $year = $request->input('year', Carbon::now()->format('Y'));
        $week = $request->input('week', Carbon::now()->format('Y-W'));

        switch ($dateRange) {
            case 'day':
                $stats = new DailyStatistics;

                return $stats->getStatistics($statusId, $month);
            case 'week':
                $stats = new WeeklyStatistics;

                return $stats->getStatistics($statusId, $week);
            case 'month':
                $stats = new MonthlyStatistics;

                return $stats->getStatistics($statusId, $year);
            case 'year':
                $stats = new YearlyStatistics;

                return $stats->getStatistics($statusId, $year);
            default:
                return response()->json(['error' => 'Invalid date_range parameter'], 400);
        }
    }

    /**
     * @throws \Exception
     */
    protected function getOrderQuery($interval, $startDate, $endDate, $statusId): Builder
    {
        $databaseDriver = DB::getDriverName();

        $dateQuery = match ($interval) {
            'day' => ($databaseDriver == 'sqlite')
                ? DB::raw('strftime("%d", created_at) as day')
                : DB::raw('DAY(created_at) as day'),
            'week' => ($databaseDriver == 'sqlite')
                ? DB::raw('strftime("%W", created_at) as week')
                : DB::raw('WEEK(created_at, 1) as week'),
            'month' => ($databaseDriver == 'sqlite')
                ? DB::raw('strftime("%m", created_at) as month')
                : DB::raw('MONTH(created_at) as month'),
            'year' => ($databaseDriver == 'sqlite')
                ? DB::raw('strftime("%Y", created_at) as year')
                : DB::raw('YEAR(created_at) as year'),
            default => throw new \Exception('Unsupported interval'),
        };

        $query = DB::table('orders')
            ->select($dateQuery, DB::raw('SUM(total_price) as total_price'), DB::raw('COUNT(*) as order_count'))
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($statusId) {
            $query->where('status_id', $statusId);
        }

        return $query;
    }
}
