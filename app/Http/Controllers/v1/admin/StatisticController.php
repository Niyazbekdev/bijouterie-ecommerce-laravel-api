<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\FilterOrderStatsRequest;
use App\Services\v1\admin\order\OrderStats;

class StatisticController extends Controller
{
    /**
     * @throws \Exception
     */
    public function getDay(FilterOrderStatsRequest $request)
    {
        return app(OrderStats::class)->execute($request, 'day');
    }

    /**
     * @throws \Exception
     */
    public function getMonth(FilterOrderStatsRequest $request)
    {
        return app(OrderStats::class)->execute($request, 'month');
    }

    /**
     * @throws \Exception
     */
    public function getYear(FilterOrderStatsRequest $request)
    {
        return app(OrderStats::class)->execute($request, 'year');
    }

    /**
     * @throws \Exception
     */
    public function getWeek(FilterOrderStatsRequest $request)
    {
        return app(OrderStats::class)->execute($request, 'week');
    }
}
