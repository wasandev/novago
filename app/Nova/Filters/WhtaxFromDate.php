<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;

class WhtaxFromDate extends DateFilter
{
    public $name = 'จากวันที่';

    // public function default()
    // {
    //     return date('Y-m-01');
    // }
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return  $query->whereDate('pay_date', '>=', $value);
    }
}
