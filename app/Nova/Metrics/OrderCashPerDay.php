<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Trend;
use App\Models\Order_header;

class OrderCashPerDay extends Trend
{
    public $refreshWhenActionRuns = true;
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->sumByDays($request, Order_header::cash(), 'order_amount')
            ->showSumValue()
            ->format('0,0.00');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [

            30 => '30 วัน',
            60 => '60 วัน',
            365 => '365 วัน',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'order-cash';
    }
    public function name()
    {
        return 'เก็บสดต้นทางตามวัน-ทุกสาขา';
    }
}
