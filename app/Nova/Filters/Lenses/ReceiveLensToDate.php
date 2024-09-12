<?php

namespace App\Nova\Filters\Lenses;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;

class ReceiveLensToDate extends DateFilter
{
    public $name = 'ถึงวันที่';
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
        return  $query->whereDate('carreceives.receive_date', '<=', $value);
    }
}
